## SHOPPER ECOMMERCE

Developed using Laravel, my e-commerce project offers a clean and minimalist interface with powerful multi-filtering features. Users can filter by categories, color and price of products, and can also perform brand-specific searches using the search bar. With the ability to combine multiple filters and search by specific categories, shoppers can easily find the products they want and enjoy a seamless and personalized shopping experience. Explore my user-friendly and visually appealing e-commerce project for a hassle-free shopping journey.

### Technologies
* Laravel
* cviebrock/eloquent-sluggable
* laravel/ui
* intervention/image

### General functionality:

+ Home page (URL: /#/ )
    + Get and view product lists by category and subcategory
+ Sign in/Sign up pages (URL: /#/login, /#/register)
    + Authenticating users via laravel ui (login/registration pages)
+ Product page (URL: /#/product)
    + List of products
    + List of products pulled from specific category
    + Product filtering by category, price range, color and size
    + Add products to cart
    + Pagination feature
    + Sort by product name and price
+ Product detail page (URL: /#/product/{slug})
    + List product information
    + Add the product to the cart with its quantity
    + List products in a similar category to the product
+ Product detail page (URL: /#/cart)
    + List products added to cart
    + Edit, delete items in the cart
    + Adding coupons in cart
    + Buying the product
 
##### Admin Dashboard (URL: /#/panel )
- Slider page (URL: /#/panel/slider)
    - Add, delete, edit and list sliders
    - Add switch status button for slider with ajax
- Category page (URL: /#/panel/category)
    - Add, delete, edit and list category
    - Add switch status button for category with ajax
- About page (URL: /#/panel/about)
    - Show and update about
- Contact page (URL: /#/panel/contact)
    - Add, delete, edit and list contact
    - Add switch status button for contact with ajax
- Site Setting page (URL: /#/panel/setting)
    - Add, delete, edit and list site setting
    - Creating a field with ajax according to the selected input (ckeditor, textarea, text, file, image, email)

