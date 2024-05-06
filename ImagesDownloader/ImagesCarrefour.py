import requests
from bs4 import BeautifulSoup

# URL of the page to scrape
url = "https://www.carrefour.it/promozioni/?prefn1=C4_PrimaryCategory&prefv1=Acqua%2C+succhi+e+bibite"

# Send a GET request to the URL
response = requests.get(url)

# Parse the HTML content
soup = BeautifulSoup(response.content, "html.parser")

# Find all product items
product_items = soup.select("div.product-grid > div.product-item")

# Iterate over each product item
for product_item in product_items:
    # Extract the link, image, name, and price of the product
    link = product_item.select_one("div:nth-child(4) > a:nth-child(1)")["href"]
    image = product_item.select_one("div:nth-child(4) > a:nth-child(1) > div:nth-child(4) > div:nth-child(1) > img:nth-child(1)")["src"]
    name = product_item.select_one("a > h3 > span:nth-child(2)").text
    price = product_item.select_one("div:nth-child(4) > div:nth-child(3) > div:nth-child(1) > span:nth-child(2) > span:nth-child(1) > span:nth-child(2)").text

    # Print the extracted information
    print("Link:", link)
    print("Image:", image)
    print("Name:", name)
    print("Price:", price)
    print()