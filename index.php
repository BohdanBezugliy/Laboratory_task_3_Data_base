<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
  crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
  crossorigin="anonymous"></script>
  <title>Hotels</title>
</head>
<body style="display: flex; flex-direction: column; align-items: center;">
    <form method="post" action="index.php" style="width:50%;">
        <label for="name" class="form-label m-1">Назва готелю</label>
        <input type="text" class="form-control m-1" name="name" placeholder="Введіть ALL для виводу всіх рядків">
        <button type="submit" class="btn btn-primary m-1">Пошук</button>
    </form>
    <table class="table table-striped">
      <tr>
          <th>
                Назва готелю
          </th>
          <th>
                Код готелю
          </th>
          <th>
                Рівень сервісу
          </th>
          <th>
                Адреса
          </th>
          <th>
                Район
          </th>
      </tr>
      <?php
          $dsn = 'mysql:host=localhost:3306;dbname=Accommodation_of_guests';
          $username = 'root';
          $password = 'son20152015';
          try {
              $dbConnection = new PDO($dsn, $username, $password);
          } catch (PDOException $e) {
              echo 'Помилка підключення до бази даних: ' . $e->getMessage();
              exit;
          }
          $name = $_POST['name'];
          if ($name == 'ALL') {
            $sql = "SELECT * FROM Hotels_city";
            $stmt = $dbConnection->prepare($sql);
            $stmt->execute();
          }else{
            $sql = "SELECT * FROM Hotels_city WHERE Name = :name";
            $stmt = $dbConnection->prepare($sql);
            $stmt->execute([
            'name'=>$name
          ]);
          }
          $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);
          $i = 1;
          foreach($hotels as $key => $hotel){
              echo "<tr>
                  <td>
                      {$hotel["Name"]}
                  </td>
                  <td>
                      {$hotel["Code"]}
                  </td>
                  <td>
                        {$hotel["Level_of_services"]}
                  </td>
                  <td>
                        {$hotel["Address"]}
                  </td>
                  <td>
                        {$hotel["District_of_the_city"]}
                  </td>
              </tr>";
              $i++;
          }
          $stmt = null;
          $dbConnection = null;
      ?>
  </table>
</body>
</html>