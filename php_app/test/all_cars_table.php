<!-- List of Cars -->
<form>
<h2>All Cars</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Brand</th>
        <th>Year</th>
    </tr>
    <?php
    $cars = getAllCars();
    foreach ($cars as $car) {
        echo "<tr><td>{$car['Id']}</td><td>{$car['Brand']}</td><td>{$car['Year']}</td></tr>";
    }
    ?>
</table>
</form>
