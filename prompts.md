You're creating a Hotel management system in Laravel for a single hotel. Create the database files for Room and RoomType models:
- Models
- Migrations with typical columns for hotel rooms and room types, each room type should have a different price per night. 
- Factories using faker library and Laravel fake() helper and not $this->faker
- Seeders for typical Room types for a hotel and 10-20 rooms for each type

---

Change column status in rooms to boolean column is_available, default true. Change migrations, models, factories and seeders accordingly. In seeder, 90% of rooms should be available.

Also, in seeders for room numbers and floors, use a proper logical sequence instead of fake data. Room numbers should go in incremental order, and the first digit should correspond to their floor number. Assign room type to each room randomly.

---

I noticed migrations are with prefix of 2024_03_20. Please change it to the current date which is 2024-12-28.

---

Generate Filament resource to manage Room Types. Show table columns name, price per night, capacity. For the Form, for amenities use CheckboxList.

---

Generate default Filament pages for RoomTypeResource

---

Generate Filament resource for Room model.

---

Change RoomType amenities from json to be a separate Model Amenity with a many-to-many relationship to RoomType.

Also, generate a Seeder for Amenities and change the factory of RoomType accordingly to use the values from that Seeder.

Also, change Filament Resource form method to use CheckboxList with multiple relationship.

---

Generate a Tailwind homepage for a hotel and place it into welcome.blade.php instead of the default Laravel homepage.

Elements of the page:
- A big photo background: use some free image from Unsplash or other platform
- Form to search the room by fields of date from (default tomorrow) and date to (default today + 5 days) and number of people staying
- A footer with main information like email, phone number and links to social profiles

In Blade, use Vite with Laravel 11 syntax and not Tailwind from CDN.

---

In the welcome.blade.php, remove the links on the top-right and footer Quick Links section.

---

Create a SearchRoomsController invokable controller, change the search-rooms route to use it.

In Controller method, return all RoomType records with amenities that fit the capacity of guests requested, ordered by room type price per night, ascending. 

Build Blade View file to show all those room types, in separate blocks/sections. Use Tailwind and re-use header/footer from welcome.blade.php. On that page, for each room type, show name, price per night, list of amenities and a link "Book Now" that leads to the new route of "booking" with the parameters of date from/to, guests (from requests) and room type ID. Create that new Route which doesn't return anything yet.

---

Add a column of "size" (in square meters) to RoomType. Add appropriate values to the seeder. Show that size in the rooms search results, near amenities list.

---

We need a photo field for Room Type. For that, let's use a package Spatie Media Library. 

In the Model, specify media thumbnail size so it would fit nicely on the rooms-search results list. 

In Filament, add the form field in the Room Type resource to manage this photo. 

In the search-rooms results, add the code for some placeholder thumbnail no-photo, if there's no photo uploaded for the room type.