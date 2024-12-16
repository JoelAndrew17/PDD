import json
import google.generativeai as genai

# Configure Gemini AI
genai.configure(api_key="AIzaSyDNFOTeXe9pEhEjcpcTB0GAx1VZGhliCcQ")

# Create the model
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
  system_instruction="You are a medical assistant AI trained to analyze symptoms and issues provided in patient records. Identify potential conditions or areas of concern based on the provided data and suggest possible next steps for the medical team. You are an AI that classifies medical data by severity. When analyzing pain and issue descriptions, determine whether the situation is 'low urgency,' 'medium urgency,' or 'high urgency.' Provide a brief explanation of your classification and suggest an appropriate action. You are an AI used for patient risk assessment. Evaluate the described pain and issue levels, prioritize their risks from 1 (low), 2 (medium) and 3 (high), you analyze the text you recieve from analyzing the Electronic health records and link the pain and issue with the content of the EHR "
)

chat_session = model.start_chat(
  history=[]
)

# Load the extracted data
with open("extracted_data.json", "r") as json_file:
    extracted_data = json.load(json_file)

# Pass extracted data into Gemini AI
flage = True
while flage:
    req = input("Enter your queries: ")
    if req.lower() == "exit":
        flage = False
        print("Thanks for using our service. Have a great day!")
        break

    user_context = f"The extracted data is: {json.dumps(extracted_data)}. User query: {req}"
    response = chat_session.send_message(user_context)
    print(response.text)
