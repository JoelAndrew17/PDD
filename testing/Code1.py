import os
import json
from http.server import BaseHTTPRequestHandler, HTTPServer
import google.generativeai as genai
import fitz  # PyMuPDF
import pdfplumber
from PIL import Image
import io

# Define the absolute base path to your files
BASE_PATH = r"D:\xamp\htdocs\med\login\homepage"

class MyHandler(BaseHTTPRequestHandler):
    def do_POST(self):
        # Get the content length from the headers
        content_length = int(self.headers['Content-Length'])
        post_data = self.rfile.read(content_length)
        
        # Decode the JSON data
        received_data = json.loads(post_data.decode('utf-8'))
        pdf_files = received_data['doc_file'].split(",")  # Handle multiple files

        # Extract and combine data from the PDFs
        combined_data = {"text": "", "links": [], "images": [], "tables": []}
        for pdf_file in pdf_files:
            pdf_path = os.path.join(BASE_PATH, pdf_file.strip())
            print(f"Resolved PDF Path: {pdf_path}")  # Debug the resolved path
            
            extracted_data = self.extract_pdf_content(pdf_path)
            combined_data["text"] += extracted_data.get("text", "")
            combined_data["links"].extend(extracted_data.get("links", []))
            combined_data["images"].extend(extracted_data.get("images", []))
            combined_data["tables"].extend(extracted_data.get("tables", []))

        # Configure the AI
        genai.configure(api_key="AIzaSyDNFOTeXe9pEhEjcpcTB0GAx1VZGhliCcQ")
        generation_config = {
            "temperature": 1,
            "top_p": 0.95,
            "top_k": 40,
            "max_output_tokens": 8192,
            "response_mime_type": "text/plain",
        }

        model = genai.GenerativeModel(
            model_name="gemini-1.5-flash",
            generation_config=generation_config,
            system_instruction=("You are a medical assistant AI trained to analyze symptoms and issues provided in patient records. "
                "Your response must be structured with the following fields:\n"
                "1. Condition: Briefly describe the medical condition.\n"
                "2. Reason: Provide a clear reason or explanation for the condition.\n"
                "3. Analysis: Analyze the provided EHR and its implications in detail.\n"
                "Ensure your response begins each section with 'Condition:', 'Reason:', and 'Analysis:' respectively."),
        )

        chat_session = model.start_chat(history=[])

        # Combine extracted PDF text with the user's pain and issue descriptions
        user_input = f"Patient details:\nPain: {received_data['pain']}\nIssue: {received_data['issue']}\n"
        user_input += f"Extracted PDF Data:\n{combined_data['text'][:1000]}"  # Limit text to 1000 characters for input
        
        # Interact with the AI
        response = chat_session.send_message(user_input)
        print("Generated Response:", response.text)

        # Parse the AI's response into structured fields
        structured_response = self.parse_ai_response(response.text)

        # Prepare the response JSON
        response_data = {
            "condition": structured_response.get("condition", "N/A"),
            "reason": structured_response.get("reason", "N/A"),
            "analysis": structured_response.get("analysis", "N/A")
        }
        response_json = json.dumps(response_data)
        
        # Send response
        self.send_response(200)
        self.send_header('Content-Type', 'application/json')
        self.end_headers()
        self.wfile.write(response_json.encode('utf-8'))

    def extract_pdf_content(self, pdf_path):
        if not os.path.exists(pdf_path):
            print(f"File not found: {pdf_path}")
            return {"text": "", "links": [], "images": [], "tables": []}

        extracted_data = {
            "text": "",
            "links": [],
            "images": [],
            "tables": []
        }

        try:
            pdf_document = fitz.open(pdf_path)

            # Extract Text and Links
            for page_number in range(len(pdf_document)):
                page = pdf_document[page_number]
                extracted_data["text"] += page.get_text()
                links = page.get_links()
                if links:
                    extracted_data["links"].extend([link.get("uri") for link in links if link.get("uri")])

            # Extract Images
            for page_number in range(len(pdf_document)):
                page = pdf_document[page_number]
                images = page.get_images(full=True)
                for img_index, img in enumerate(images):
                    xref = img[0]
                    base_image = pdf_document.extract_image(xref)
                    image_bytes = base_image["image"]
                    image_ext = base_image["ext"]
                    image_filename = f"page{page_number + 1}_img{img_index + 1}.{image_ext}"
                    image = Image.open(io.BytesIO(image_bytes))
                    image.save(image_filename)
                    extracted_data["images"].append(image_filename)

            # Extract Tables
            with pdfplumber.open(pdf_path) as pdf:
                for page_number, page in enumerate(pdf.pages, start=1):
                    tables = page.extract_tables()
                    if tables:
                        extracted_data["tables"].append(tables)

            pdf_document.close()

        except Exception as e:
            print(f"Error extracting content from {pdf_path}: {e}")
        
        return extracted_data

    def parse_ai_response(self, response_text):
        parsed_response = {}
        try:
            parts = response_text.split("\n")
            for part in parts:
                if part.startswith("Condition:"):
                    parsed_response["condition"] = part.replace("Condition:", "").strip()
                elif part.startswith("Reason:"):
                    parsed_response["reason"] = part.replace("Reason:", "").strip()
                elif part.startswith("Analysis:"):
                    parsed_response["analysis"] = part.replace("Analysis:", "").strip()
        except Exception as e:
            print("Error parsing AI response:", str(e))
        
        return parsed_response


# Start the server
server_address = ('', 8000)
httpd = HTTPServer(server_address, MyHandler)
print("Python server is running...")
httpd.serve_forever()
