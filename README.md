# E-Commerce Management System

## Project Overview

The **E-Commerce Management System** is a comprehensive web application designed to manage multiple user roles, including Admin, Buyer, Seller, Delivery Personnel, and Employee. The system provides functionalities such as user authentication, profile management, product management, order management, and dynamic interactions using PHP, MySQL, HTML, CSS, and JavaScript.
# Homepage
![image](https://github.com/user-attachments/assets/2e4c744d-62ea-4f5e-adb6-217b550d4e33)

---

## Login and Registration
![image](https://github.com/user-attachments/assets/3bfc450a-3f82-46a6-8005-c57d53627bda)

---

![image](https://github.com/user-attachments/assets/2b43caf5-324c-4ac9-ac46-6e2c8b68e39c)


### Admin
- Manage users (Buyers, Sellers, Employees, Delivery Personnel).
- View and manage all products and orders.
- Update and delete user profiles.
- Dashboard with quick access to all functionalities.

# Admin Dashboard
![image](https://github.com/user-attachments/assets/46f17014-295e-4bb2-85ec-beb3d4332842)


### Buyer
- Register, log in, and manage profile.
- Browse and search for products.
- Add products to the cart and place orders.
- View order history and manage account balance.
# Buyer Dashboard
![image](https://github.com/user-attachments/assets/9ffe7379-84e2-4285-a0c0-f7b2d37563bb)

### Seller
- Add, edit, and delete products.
- View product history and manage inventory.
- Search for specific products.
- Manage profile and account details.
#Seller Dashboard
![image](https://github.com/user-attachments/assets/8831a503-3183-4f3b-a03c-a2415ee82180)


### Delivery Personnel
- View and update delivery profile.
- Manage assigned orders and update delivery status.
- Search for orders and deliveries.
# Delivery Dashboard
![image](https://github.com/user-attachments/assets/18d3942b-f703-49c8-84de-54200f89ac15)


### Employee
- View and update employee profile.
- Manage assigned tasks and work shifts.
# Employee Dashboard
![image](https://github.com/user-attachments/assets/8e83c5fe-4ee3-4713-9cc6-bb9803465bc1)


---

## Technologies Used

- **Backend**: PHP
- **Frontend**: HTML, CSS, JavaScript
- **Database**: MySQL
- **Server**: XAMPP (Apache, MySQL)
- **Version Control**: Git

---

## Folder Structure

```
c:/xampp/htdocs/Web_Project/
├── admin/
│   ├── control/
│   ├── css/
│   ├── model/
│   ├── view/
├── buyer/
│   ├── control/
│   ├── css/
│   ├── js/
│   ├── model/
│   ├── view/
├── delivery/
│   ├── control/
│   ├── css/
│   ├── js/
│   ├── model/
│   ├── view/
├── employee/
│   ├── control/
│   ├── css/
│   ├── js/
│   ├── model/
│   ├── view/
├── seller/
│   ├── control/
│   ├── css/
│   ├── js/
│   ├── model/
│   ├── view/
├── layout/
│   ├── view/
```

---

## Installation

1. Clone the repository into your local server directory:
   ```bash
   git clone <repository-url> c:/xampp/htdocs/Web_Project
   ```

2. Start the XAMPP server and ensure Apache and MySQL are running.

3. Import the database:
   - Open `phpMyAdmin` in your browser.
   - Create a new database named `project`.
   - Import the SQL file provided in the repository.

4. Update database credentials:
   - Open the `db.php` files in the `model` folders for each module.
   - Ensure the database credentials match your local setup:
     ```php
     $dbhost = "localhost";
     $dbusername = "root";
     $dbpassword = "";
     $dbname = "project";
     ```

5. Access the application:
   - Open your browser and navigate to `http://localhost/Web_Project`.

---

## Usage

### Admin
- Navigate to the Admin Dashboard to manage users, products, and orders.

### Buyer
- Register and log in to browse products, add to cart, and place orders.

### Seller
- Log in to manage products and view product history.

### Delivery Personnel
- Log in to manage deliveries and update delivery statuses.

### Employee
- Log in to view and update profile details.

---

## Contributing

1. Fork the repository.
2. Create a new branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Commit your changes:
   ```bash
   git commit -m "Add your message here"
   ```
4. Push to the branch:
   ```bash
   git push origin feature/your-feature-name
   ```
5. Open a pull request.

---

