<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update.css">
    <title>Update Pendaftar</title>
</head>
<body>
    <?php
        // Initialize variables to avoid undefined variable warnings
        $id = $name = $email = $phone = $gender = $date_of_birth = $position = "";

        $conn = new mysqli("localhost", "root", "", "voli_db");
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM pendaftar WHERE id=$id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $name = $row['full_name'];
                $email = $row['email'];
                $phone = $row['phone'];
                $gender = $row['gender'];
                $date_of_birth = $row['date_of_birth'];
                $position = $row['position'];
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $name = $_POST['full-name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $gender = $_POST['gender'];
            $date_of_birth = $_POST['dob'];
            $position = $_POST['position'];

            $sql = "UPDATE pendaftar SET 
                        full_name='$name', 
                        email='$email', 
                        phone='$phone', 
                        gender='$gender', 
                        date_of_birth='$date_of_birth', 
                        position='$position'  
                    WHERE id=$id";
            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }

        $conn->close();
    ?>

    <div class="container">
        <div class="form-container">
            <h2>Update Data Pendaftar</h2>
            <form method="POST" action="">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <label for="full-name">Nama Lengkap:</label>
                <input type="text" name="full-name" value="<?php echo htmlspecialchars($name); ?>" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br>

                <label for="phone">Nomor Telepon:</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required><br>

                <label for="position">Posisi di Tim:</label>
                <select name="position" required>
                    <option value="Striker" <?php echo ($position == 'Striker') ? 'selected' : ''; ?>>Striker</option>
                    <option value="Midfielder" <?php echo ($position == 'Midfielder') ? 'selected' : ''; ?>>Midfielder</option>
                    <option value="Defender" <?php echo ($position == 'Defender') ? 'selected' : ''; ?>>Defender</option>
                    <option value="Goalkeeper" <?php echo ($position == 'Goalkeeper') ? 'selected' : ''; ?>>Goalkeeper</option>
                </select><br>

                <label for="gender">Jenis Kelamin:</label>
                <select name="gender" required>
                    <option value="Laki-laki" <?php echo ($gender == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo ($gender == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select><br>

                <label for="dob">Tanggal Lahir:</label>
                <input type="date" name="dob" value="<?php echo htmlspecialchars($date_of_birth); ?>" required><br>

                <button type="submit">Update</button>
            </form>
        </div>
    </div>
</body>
</html>
