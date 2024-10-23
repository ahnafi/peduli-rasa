<?php
echo "halaman update postingan" ;
?>


<form action="/update" method="POST" enctype="multipart/form-data">
    <!-- Title -->
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" required>

    <!-- Description -->
    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required></textarea>

    <!-- Location -->
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required>

    <!-- Post Date (using datetime-local) -->
    <label for="postDate">Post Date:</label>
    <input type="datetime-local" id="postDate" name="postDate" required>

    <!-- Category -->
    <label for="categoryId">Category:</label>
    <select id="categoryId" name="categoryId" required>
        <option value="">Select Category</option>
        <option value="1">Category 1</option>
        <option value="2">Category 2</option>
        <!-- Add more categories as needed -->
    </select>

    <!-- Submit Button -->
    <button type="submit">Upload Post</button>
</form>

