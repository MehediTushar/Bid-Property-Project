<!-- filter_form.php -->
<form action="filter_results.php" method="get">
    <div class="form-group">
        <label for="price_range">Price Range</label>
        <input type="number" name="min_price" placeholder="Min Price" step="0.01">
        <input type="number" name="max_price" placeholder="Max Price" step="0.01">
    </div>
    <div class="form-group">
        <label for="bedrooms">Number of Bedrooms</label>
        <select name="bedrooms">
            <option value="">Any</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4+</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Apply Filters</button>
</form>
