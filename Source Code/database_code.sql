-- Drop old database if it exists
DROP DATABASE IF EXISTS library_manager;

-- Create the database
CREATE DATABASE library_manager;
USE library_manager;

-- Categories table
CREATE TABLE categories (
    categoryID    INT AUTO_INCREMENT PRIMARY KEY,
    categoryName  VARCHAR(255) NOT NULL
);

-- Products table (books)
CREATE TABLE products (
    productID     INT AUTO_INCREMENT PRIMARY KEY,
    categoryID    INT NOT NULL,
    productCode   VARCHAR(10) NOT NULL,
    productName   VARCHAR(255) NOT NULL,
    listPrice     DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (categoryID) REFERENCES categories(categoryID)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

-- Insert 3 book categories
INSERT INTO categories (categoryName) VALUES
('Philosophical'),   -- id = 1
('Literature'),   -- id = 2
('Historical');      -- id = 3

-- Insert 5 Philosophy books
INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES
(1, 'rep',   'Plato - The Republic', 25.00),
(1, 'eth',   'Aristotle - Nicomachean Ethics', 22.50),
(1, 'med',   'Marcus Aurelius - Meditations', 18.99),
(1, 'beyo',  'Nietzsche - Beyond Good and Evil', 21.75),
(1, 'sim',   'Descartes - Meditations on First Philosophy', 19.50);

-- Insert 5 Literature books
INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES
(2, 'mock',  'Harper Lee - To Kill a Mockingbird', 15.99),
(2, 'pride', 'Jane Austen - Pride and Prejudice', 12.50),
(2, 'gatsby','F. Scott Fitzgerald - The Great Gatsby', 14.00),
(2, '1984',  'George Orwell - 1984', 13.25),
(2, 'ham',   'William Shakespeare - Hamlet', 11.75);

-- Insert 5 History books
INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES
(3, 'ww2',   'Antony Beevor - The Second World War', 30.00),
(3, 'rome',  'Mary Beard - SPQR: A History of Ancient Rome', 28.00),
(3, 'guns',  'Jared Diamond - Guns, Germs, and Steel', 24.00),
(3, 'cold',  'John Lewis Gaddis - The Cold War', 27.50),
(3, 'sapi',  'Yuval Noah Harari - Sapiens: A Brief History of Humankind', 29.99);
