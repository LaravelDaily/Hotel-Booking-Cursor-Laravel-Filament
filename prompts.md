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