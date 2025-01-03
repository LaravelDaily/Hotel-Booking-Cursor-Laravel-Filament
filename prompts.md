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

---

Create a BookingController with methods create() and store(). Replace the "booking" route with create() method of this Controller. 

That method should return the Blade view with the form for the booking, with layout almost identical to the welcome.blade.php, re-using the same header/footer and background image.

That form should contain fields: check-in and check-out date, number of guests (all three disabled but with hidden input values), and then non-disabled fields of customer name and email.

Also, somewhere on the page, there should be a calculation of how many nights and how much price to pay, multiplying the date range by the price per night. Specify on the page that the payment is made upon arrival. Calculate the price in a specific PricingService, used in the Controller.

Form action should be the store() method of the Controller, empty for now, will build its code later.

---

Fill in the store() method of BookingController, creating the new Customer (firstOrCreate) with name and email, and then creating the Booking assigned to that customer. Use Laravel validation and database transaction. 

For the Booking room_id, choose the first room for that room_type_id, available within the requested dates. Make that request outside of database transaction, if no room found - return back with a validation error.

If booking successful, redirect to a new confirmation page. Add the booking confirmation method in the Controller and the Routes. It should just show text page, with the same header, footer and background image as the welcome.blade.php. In the middle section, it should just say "Booking successful" and add a link to the homepage.

---

Create Filament Resource to view Customers. There should be only Index and Edit pages, no ability to Create New customer or Delete customer.

Also, create Filament Resource to view Bookings. There should be only Index page, no ability to create/edit/delete bookings. In the table, show booking check in and check out dates, amount of nights, customer name and email, room number and room type name, total price and when booking was created.