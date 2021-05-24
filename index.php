<!DOCTYPE html>
<html>

<head>

<style>
body {
    font-family: Arial;
    width: 550px;
}

.outer-scontainer {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-top: 0px;
    margin-bottom: 20px;
}

.btn-submit {
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor: pointer;
}

.outer-scontainer table {
    border-collapse: collapse;
    width: 100%;
}

.outer-scontainer th {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.outer-scontainer td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">

</script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h2>Catch Duplicate Users</h2>

    <div class="outer-scontainer">
        <div class="row">

            <form action="handle-form-data.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email Address">
                </div>

                <div class="form-group">
                    <input type="text" name="first_name" class="form-control" placeholder="First Name">
                </div>

                <div class="form-group">
                    <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                </div>

                <div class="form-group">
                    <input type="text" name="dob" class="form-control" placeholder="DOB mm-dd-yy">
                </div>

                <div class="form-group">
                    <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
                </div>

                <button type="submit" class="btn btn-primary">Register</button>

            </form>

        </div>
    </div>

</body>

</html>