import os
import mysql.connector
import requests
from bs4 import BeautifulSoup

# Function to search for image URLs on Bing Images
def search_image(query):
    url = f"https://www.bing.com/images/search?q={query}"
    headers = {
        "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3"
    }
    response = requests.get(url, headers=headers)
    soup = BeautifulSoup(response.text, "html.parser")
    image_tags = soup.find_all("img", class_="mimg")
    if image_tags:
        return image_tags[0]["src"]  # Return the URL of the first image found
    else:
        return None

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

# SQL query to fetch records
sql_query = "SELECT * FROM products"
cursor.execute(sql_query)
products = cursor.fetchall()

# Directory to save images
image_dir = "products"
if not os.path.exists(image_dir):
    os.makedirs(image_dir)

# Loop through products, search for images, download them, and update database
for product in products:
    print(product)
    name = product[0]  # Extracting the name from the fetched record
    query = f"{name}"
    image_url = search_image(query)
    if image_url:
        image_filename = f"{name.lower().replace(' ', '_')}.jpg"        image_path = product[2]
        
        # Download the image if not already downloaded
        if not os.path.exists(image_path):
            download_image(image_url, image_path)
        else:
            print(f"Image {image_filename} already exists locally.")

    else:
        print(f"No image found for {name}")

# Commit changes and close connection
conn.commit()
conn.close()
