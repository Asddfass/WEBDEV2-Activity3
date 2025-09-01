<?php 
    $product_name = "";
    $product_name_error = "";
    $category = "";
    $category_error = "";
    $price = 0.0;
    $price_error = "";
    $stock_count = 0;
    $stock_count_error = "";
    $expiration_date = 0;
    $expiration_date_error = "";
    $status = "";
    $status_error = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $product_name = trim(htmlspecialchars($_POST["product_name"]));
        if (empty($product_name))
        {
            $product_name_error = "Product name is required";
        }

        $category = trim(htmlspecialchars($_POST["category"]));
        if (empty($category))
        {
            $category_error = "Category is Required";
        }
        
        $price = trim(htmlspecialchars($_POST["price"]));
        if (empty($price))
        {
            $price_error = "Price is Required";
        }
        else if (!is_numeric($price))
        {
            $price_error = "Price must be a number";
        }

        $stock_count = trim(htmlspecialchars($_POST["stock_quantity"]));
        if (empty($stock_count))
        {
            $stock_count_error = "Stock Quantity is Required";
        }
        else if (!is_numeric($stock_count))
        {
            $stock_count_error = "Stock Quantity must be a number";
        }

        $expiration_date = trim(htmlspecialchars($_POST["expiration_date"]));
        if (empty($expiration_date))
        {
            $expiration_date_error = "Expiration Date is Required";
        }
        else if (strtotime($expiration_date) < strtotime(date("Y-m-d")))
        {
            $expiration_date_error = "Expiration Date cannot be in the past";
        }
        
        //$status = trim(htmlspecialchars($_POST["status"]));
        if (empty($status))
        {
            $status_error = "Status is Required";
        }

        if (
            !empty($product_name) && !empty($category) && !empty($price) && 
            is_numeric($price) && !empty($expiration_date) && 
            strtotime($expiration_date) > strtotime(date("Y-m-d")) && 
            !empty($status)
            )
        {
            header("Location: redirect.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALI's FORM</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <!--
        THE DIFFERENCE BETWEEN THEM IS THAT THE GET METHOD CHANGES THE URL AND PUT
        WHAT YOU ENTER IN THE FORM TO THE URL WHEN SUBMITTING AND THE POST METHOD 
        DOESN'T CHANGE THE URL WHEN SUBMITTING IT IS STILL THE SAME
    -->
    <form action="" method="POST">
        <label for="">Product Name:</label>
        <input type="text" name="product_name" value="<?php echo $product_name?>">
        <p class="error"><?php echo $product_name_error;?></p>
        <label for="">Category:</label><br>
        <select name="category">
            <option value="">-- Select Category --</option>
            <option value="Category A" <?php if ($category=='Category A') echo "selected";?>>"Category A</option>
            <option value="Category B" <?php if ($category=='Category B') echo "selected";?>>"Category B</option>
            <option value="Category C" <?php if ($category=='Category C') echo "selected";?>>"Category C</option>
            <option value="Category D" <?php if ($category=='Category D') echo "selected";?>>"Category D</option>
        </select><br>
        <p class="error"><?php echo $category_error;?></p>
        <label for="">Price (&#8369):</label><br>
        <input type="number" name="price" step="0.01" value="<?php echo $price?>"><br>
        <p class="error"><?php echo $price_error;?></p>
        <label for="">Stock Quantity:</label><br>
        <input type="number" name="stock_quantity" min="0" value="<?php echo $stock_count?>"><br>
        <p class="error"><?php echo $stock_count_error;?></p>
        <label for="">Expiration Data:</label><br>
        <input type="date" name="expiration_date" value="<?php echo $expiration_date?>"><br>
        <p class="error"><?php echo $expiration_date_error;?></p>
        <label for="">Status:</label><br>
        <p class="error"><?php echo $status_error;?></p>
        <input type="radio" name="status" value="active" <?php if ($status=="active") echo "checked";?>> Active<br>
        <input type="radio" name="status" value="inactive" <?php if ($status=="inactive") echo "checked";?>> Inactive<br><br>
        <input type="submit" value="Save Product">
    </form>
</body>

</html>
