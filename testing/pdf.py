import fitz  # PyMuPDF
import pdfplumber
import os
import json
from PIL import Image
import io

# Path to the PDF
pdf_path = "d:/xamp/htdocs/med/login/testing/SampleOne.pdf"

# Check if the file exists
if not os.path.exists(pdf_path):
    print(f"Error: File not found at {pdf_path}")
else:
    pdf_document = fitz.open(pdf_path)

    extracted_data = {
        "text": [],
        "links": [],
        "images": [],
        "tables": []
    }

    # Extract Text and Links
    for page_number in range(len(pdf_document)):
        page = pdf_document[page_number]
        extracted_data["text"].append(page.get_text())
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

    # Save the extracted data to a JSON file
    with open("extracted_data.json", "w") as json_file:
        json.dump(extracted_data, json_file)

    print("Data extracted and saved to extracted_data.json")
