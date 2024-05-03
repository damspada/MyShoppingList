import os
import mysql.connector
import requests
from bs4 import BeautifulSoup
from flask import Flask, render_template, request
from werkzeug.utils import secure_filename

app = Flask(__name__)

# Function to search for image URLs on Bing Images
def search_images(query):
    url = f"https://www.bing.com/images/search?q={query}"
    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3"
    }
    response = requests.get(url, headers=headers)
    soup = BeautifulSoup(response.text, "html.parser")
    image_tags = soup.find_all("img", class_="mimg")
    if image_tags:
        return [img["src"] for img in image_tags[:5]]  # Return URLs of first five images found
    else:
        return []

# Function to download image from URL and save locally
def download_image(url, filepath):
    try:
        response = requests.get(url)
        with open(filepath, 'wb') as f:
            f.write(response.content)
        print(f"Downloaded image from {url} and saved to {filepath}")
    except Exception as e:
        print(f"Failed to download image from {url}: {e}")

# Define the database connection
db_config = {
    "host": "127.0.0.1",
    "user": "root",
    "password": "",
    "database": "MyShopping"
}

conn = mysql.connector.connect(**db_config)
cursor = conn.cursor()

# Route for the home page
@app.route('/')
def index():
    cursor.execute("SELECT * FROM products")
    products = cursor.fetchall()
    return render_template('index.html', products=products)

# Route to handle image selection and download
@app.route('/download', methods=['POST'])
def download():
    product_name = request.form['product_name']
    selected_image_url = request.form['selected_image_url']
    image_path = f"products/{secure_filename(product_name)}.jpg"

    # Download the selected image
    download_image(selected_image_url, image_path)

    return "Image downloaded successfully!"

if __name__ == '__main__':
    app.run(debug=True)
