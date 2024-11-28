-- Create the database
CREATE DATABASE IF NOT EXISTS home_finder;
USE home_finder;

-- Create the properties table
CREATE TABLE IF NOT EXISTS properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    price DECIMAL(12, 2) NOT NULL,
    property_type VARCHAR(50) NOT NULL,
    bedrooms INT NOT NULL,
    bathrooms INT NOT NULL,
    square_feet INT NOT NULL,
    image_url TEXT NOT NULL,
    description TEXT NOT NULL,
    year_built INT,
    garage BOOLEAN DEFAULT FALSE,
    parking_spaces INT DEFAULT 0,
    lot_size DECIMAL(10, 2),
    furnished BOOLEAN DEFAULT FALSE,
    air_conditioning BOOLEAN DEFAULT FALSE,
    heating BOOLEAN DEFAULT FALSE,
    balcony BOOLEAN DEFAULT FALSE,
    garden BOOLEAN DEFAULT FALSE,
    pool BOOLEAN DEFAULT FALSE,
    security_system BOOLEAN DEFAULT FALSE,
    pet_friendly BOOLEAN DEFAULT FALSE,
    status VARCHAR(50) DEFAULT 'available',
    listing_type VARCHAR(50) DEFAULT 'sale',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample properties
INSERT INTO properties (
    title, location, price, property_type, bedrooms, bathrooms, square_feet, 
    image_url, description, year_built, garage, parking_spaces, lot_size, 
    furnished, air_conditioning, heating, balcony, garden, pool, security_system, 
    pet_friendly, status, listing_type
) VALUES
('Modern Apartment in City Center', 'New York, NY', 300000, 'apartment', 2, 1, 1000, 
'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg', 
'Beautiful modern apartment in the heart of the city', 2015, false, 1, 0.00, 
true, true, true, true, false, false, true, true, 'available', 'sale'),

('Luxury Villa with Pool', 'Los Angeles, CA', 1200000, 'villa', 5, 4, 3500, 
'https://images.pexels.com/photos/32870/pexels-photo.jpg', 
'Stunning villa with private pool and garden', 2010, true, 3, 0.25, 
false, true, true, true, true, true, true, true, 'available', 'sale'),

('Cozy Family House', 'Chicago, IL', 450000, 'house', 3, 2, 1800, 
'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg', 
'Perfect family home in a quiet neighborhood', 2005, true, 2, 0.15, 
false, true, true, false, true, false, true, true, 'available', 'sale'),

('Waterfront Apartment', 'Miami, FL', 550000, 'apartment', 2, 2, 1200, 
'https://images.pexels.com/photos/1571468/pexels-photo-1571468.jpeg', 
'Beautiful apartment with ocean views', 2018, false, 1, 0.00, 
true, true, true, true, false, false, true, true, 'available', 'sale'),

('Modern Villa', 'San Francisco, CA', 2500000, 'villa', 6, 5, 4500, 
'https://images.pexels.com/photos/1732414/pexels-photo-1732414.jpeg', 
'Luxurious modern villa with city views', 2020, true, 4, 0.35, 
false, true, true, true, true, true, true, true, 'available', 'sale'),

('Penthouse Apartment with Skyline View', 'Seattle, WA', 850000, 'apartment', 3, 3, 2000, 
'https://images.pexels.com/photos/1571473/pexels-photo-1571473.jpeg', 
'Luxurious penthouse apartment with panoramic city views and modern amenities', 2019, true, 2, 0.00, 
true, true, true, true, false, false, true, true, 'available', 'sale'),

('Mediterranean Villa Estate', 'Beverly Hills, CA', 4500000, 'villa', 7, 6, 6000, 
'https://images.pexels.com/photos/1732414/pexels-photo-1732414.jpeg', 
'Spectacular Mediterranean-style villa with extensive gardens and entertainment areas', 2015, true, 5, 0.75, 
false, true, true, true, true, true, true, true, 'available', 'sale'),

('Urban Loft Apartment', 'Portland, OR', 425000, 'apartment', 1, 1, 950, 
'https://images.pexels.com/photos/1571461/pexels-photo-1571461.jpeg', 
'Modern industrial loft with high ceilings and exposed brick walls', 2017, false, 1, 0.00, 
true, true, true, false, false, false, true, true, 'available', 'sale'),

('Colonial Style House', 'Boston, MA', 875000, 'house', 4, 3, 2800, 
'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg', 
'Classic colonial house with modern updates and charming details', 1995, true, 2, 0.20, 
false, true, true, false, true, false, true, true, 'available', 'sale'),

('Beachfront Villa', 'Malibu, CA', 5500000, 'villa', 6, 7, 5500, 
'https://images.pexels.com/photos/1732414/pexels-photo-1732414.jpeg', 
'Stunning beachfront villa with private beach access and infinity pool', 2018, true, 4, 0.50, 
true, true, true, true, true, true, true, true, 'available', 'sale'),

('Downtown Studio Apartment', 'Austin, TX', 275000, 'apartment', 0, 1, 550, 
'https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg', 
'Cozy studio apartment in the heart of downtown', 2020, false, 1, 0.00, 
true, true, true, true, false, false, true, true, 'available', 'sale'),

('Mountain View Villa', 'Denver, CO', 1850000, 'villa', 5, 4, 4200, 
'https://images.pexels.com/photos/1732414/pexels-photo-1732414.jpeg', 
'Luxurious villa with stunning mountain views and outdoor living spaces', 2016, true, 3, 0.40, 
false, true, true, true, true, false, true, true, 'available', 'sale'),

('Historic Brownstone', 'Brooklyn, NY', 2250000, 'house', 4, 3, 3200, 
'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg', 
'Beautifully restored historic brownstone with original details', 1920, false, 0, 0.10, 
false, true, true, false, true, false, true, true, 'available', 'sale'),

('Eco-Friendly Smart Home', 'San Jose, CA', 1650000, 'house', 4, 3, 2600, 
'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg', 
'Modern eco-friendly smart home with solar panels and sustainable features', 2022, true, 2, 0.15, 
false, true, true, true, true, false, true, true, 'available', 'sale'),

('Luxury High-Rise Apartment', 'Chicago, IL', 750000, 'apartment', 2, 2, 1400, 
'https://images.pexels.com/photos/1571468/pexels-photo-1571468.jpeg', 
'High-end apartment with premium finishes and building amenities', 2021, true, 2, 0.00, 
true, true, true, true, false, false, true, true, 'available', 'sale'),

('Spanish Style Villa', 'San Diego, CA', 2950000, 'villa', 5, 5, 4800, 
'https://images.pexels.com/photos/1732414/pexels-photo-1732414.jpeg', 
'Elegant Spanish-style villa with courtyard and Mediterranean garden', 2014, true, 3, 0.45, 
false, true, true, true, true, true, true, true, 'available', 'sale'),

('Contemporary Glass House', 'Phoenix, AZ', 1450000, 'house', 3, 3, 2400, 
'https://images.pexels.com/photos/106399/pexels-photo-106399.jpeg', 
'Modern glass house with desert views and energy-efficient design', 2021, true, 2, 0.25, 
false, true, true, true, true, false, true, false, 'available', 'sale'),

('Waterfront Penthouse', 'Tampa, FL', 1250000, 'apartment', 3, 3, 2200, 
'https://images.pexels.com/photos/1571473/pexels-photo-1571473.jpeg', 
'Luxury penthouse with water views and private rooftop terrace', 2019, true, 2, 0.00, 
true, true, true, true, false, false, true, true, 'available', 'sale'),

('Resort-Style Villa', 'Las Vegas, NV', 3250000, 'villa', 6, 6, 5200, 
'https://images.pexels.com/photos/1732414/pexels-photo-1732414.jpeg', 
'Spectacular villa with resort-style amenities and entertainment spaces', 2017, true, 4, 0.60, 
true, true, true, true, true, true, true, true, 'available', 'sale');
