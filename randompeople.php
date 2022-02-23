<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="stylesheet.css">
    <script src="script.js"></script>
    <title>Generatore di persone</title>
  </head>  
  
  <body>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

    <a href="index.html">
      <button>torna indietro</button>
    </a>
    <a href="#tabella">
      <button>vai alla tabella</button>
    </a>
    
    <?php
      class Persona {
        // consider using an array
        public $n = 0; public $gender; public $firstname; 
        public $lastname; public $city; public $postcode; 
        public $country; public $birth; public $email; 
        public $username; public $password; public $SHA1; 
        public $phone; public $photo;

        function __construct($n, $gender, $firstname, $lastname, $city, $postcode, $country, $birth, $email, $username, $password, $SHA1, $phone, $photo) {
          $this -> n = $n;
          $this -> gender = $gender;
          $this -> firstname = $firstname;
          $this -> lastname = $lastname;
          $this -> city = $city;
          $this -> postcode = $postcode;
          $this -> country = $country;
          $this -> birth = $birth;
          $this -> email = $email;
          $this -> username = $username;
          $this -> password = $password;
          $this -> SHA1 = $SHA1;
          $this -> phone = $phone;
          $this -> photo = $photo;
        }
      }

      function stampa_resoconto($persone)
      {
        echo "<h1 class=\"display-1\">Resoconto</h1>";
        echo "<table class=\"table table-striped table-hover table-bordered\" style=\"display: block; overflow-x: auto; white-space: nowrap;\"><thead><tr>";
        echo "<th scope=\"col\">#</th>
        <th scope=\"col\">First Name</th>
        <th scope=\"col\">Last Name</th>
        <th scope=\"col\">Gender</th>
        <th scope=\"col\">City</th>
        <th scope=\"col\">Postcode</th>
        <th scope=\"col\">Country</th>
        <th scope=\"col\">Birth</th>
        <th scope=\"col\">Email</th>
        <th scope=\"col\">Username</th>
        <th scope=\"col\">Password</th>
        <th scope=\"col\">SHA1</th>
        <th scope=\"col\">Phone</th>
        <th scope=\"col\">Photo</th></tr></thead>
        <tbody>";

        foreach ($persone as $persona) {
          echo "<tr>
            <th scope=\"row\">". (($persona -> n)+1). "</th>
            <td>". ($persona -> firstname). "</td>
            <td>". ($persona -> lastname). "</td>
            <td>". ($persona -> gender). "</td>
            <td>". ($persona -> city). "</td>
            <td>". ($persona -> postcode). "</td>
            <td>". ($persona -> country). "</td>
            <td>". ($persona -> birth). "</td>
            <td>". ($persona -> email). "</td>
            <td>". ($persona -> username). "</td>
            <td>". ($persona -> password). "</td>
            <td>". ($persona -> SHA1). "</td>
            <td>". ($persona -> phone). "</td>
            <td><a href=\"". ($persona -> photo) ."\">" . ($persona -> photo) . "</a></td>
          </tr>";
        }
        
        echo "</tbody>
        </table>";
      }
    
      
      //var_dump($_POST);

      $address = $_POST["address"];
      $username = $_POST["username"];
      $password = $_POST["password"];
      $nomedb = $_POST["nomedb"];
      $tablename = $_POST["tablename"];

      require("connessionedb.php");
      
      $scelta = isset($_POST["scelta"]) ? $_POST["scelta"] : null;
      $personegenerate = [];

      if ($scelta == "delete") {
        $query = "DELETE FROM $tablename WHERE ID > 0";
        if (mysql_query($query, $conn)) {
          echo "<h1>Eliminazione completata</h1>";
        } else {
          echo "Errore nell'inserimento: " . mysql_error();
        }
        echo "<br><br><br>";
      }
      
      else if ($scelta == "gen") {
        $iterazioni = isset($_POST["gen"]) ? $_POST["gen"] : null;
        $json = file_get_contents("https://randomuser.me/api/?nat=au,ca,es,fr,us,gb&results=$iterazioni");
        $user = json_decode($json);
        
        for ($i = 0; $i < $iterazioni; $i++) {
          // tutti i campi
          $gender = $user -> results[$i] -> gender;
          $firstname = $user -> results[$i] -> name -> first;
          $lastname = $user -> results[$i] -> name -> last;
          $city = $user -> results[$i] -> location -> city;
          $postcode = $user -> results[$i] -> location -> postcode;
          $country = $user -> results[$i] -> location -> country;
          $birth = $user -> results[$i] -> registered -> date;
          $email = $user -> results[$i] -> email;
          $username = $user -> results[$i] -> login -> username;
          $password = $user -> results[$i] -> login -> password;
          $SHA1 = sha1($password);
          $phone = $user -> results[$i] -> phone;
          $photo = $user -> results[$i] -> picture -> large;
      
          $birth = substr($birth, 0, -14);
      
          $firstname = mysql_real_escape_string($firstname);
          $lastname = mysql_real_escape_string($lastname);
          $city = mysql_real_escape_string($city);
          $postcode = mysql_real_escape_string($postcode);
          $country = mysql_real_escape_string($country);
          $username = mysql_real_escape_string($username);
          $email = mysql_real_escape_string($email);
          $password = mysql_real_escape_string($password);

          $personegenerate[] = new Persona($i, $gender, $firstname, $lastname, $city, $postcode, $country, $birth, $email, $username, $password, $SHA1, $phone, $photo);
          
          echo "<h1>Persona " . ($i+1) . "</h1>";
          echo "<table><tr><td><table class=\"table table-primary table-bordered\" style=\"width: 50%;\">";

          echo "<tr><th>firstname</th>";
          echo "<td>$firstname</td></tr>";

          echo "<tr><th>lastname</th>";
          echo "<td>$lastname</td></tr>";

          echo "<tr><th>gender</th>";
          echo "<td>$gender</td></tr>";

          echo "<tr><th>city</th>";
          echo "<td>$city</td></tr>";

          echo "<tr><th>postcode</th>";
          echo "<td>$postcode</td></tr>";

          echo "<tr><th>country</th>";
          echo "<td>$country</td></tr>";

          echo "<tr><th>birth</th>";
          echo "<td>$birth</td></tr>";

          echo "<tr><th>email</th>";
          echo "<td>$email</td></tr>";

          echo "<tr><th>username</th>";
          echo "<td>$username</td></tr>";

          echo "<tr><th>password</th>";
          echo "<td>$password</td></tr>";

          echo "<tr><th>SHA1</th>";
          echo "<td>$SHA1</td></tr>";

          echo "<tr><th>phone</th>";
          echo "<td>$phone</td></tr>";
          echo "</table></td>";

          echo "<td><img src=$photo alt=1 style=\"width: 300px;\"></td></tr></table>";
      

          $strSQL = "INSERT INTO $tablename (gender, firstname, lastname, city, postcode, country, birth, email, username, password, SHA1, phone, photo)";
          $strSQL .= "VALUES ('$gender', '$firstname', '$lastname', '$city', '$postcode', '$country', '$birth', '$email', '$username', '$password', '$SHA1', '$phone', '$photo');";
          echo "<h5 class=\"display-10\"><small class=\"text-muted\">" . $strSQL . "</small></h5>";
      
          if (mysql_query($strSQL, $conn)) {
            echo "<h3 style=\"color: green;\">OK</h3>";
          } else {
            echo "Errore nell'inserimento: " . mysql_error();
            die();
          }
          echo "<br><br><br>";
        }

        // RESOCONTO
        echo "<a name=\"tabella\"></a>";
        echo stampa_resoconto($personegenerate);
      }
    
      else if ($scelta == "run") {
        if (mysql_query($_POST["run"], $conn)) {
          echo "<h3 style=\"color: green;\">OK</h3>";
        } else {
          echo "Errore nell'inserimento: " . mysql_error();
          die();
        }
      }


      
      mysql_close($conn);
    ?>
    
    <br><br>
    
    <a href="index.html">
      <button>torna indietro</button>
    </a>
  </body>
</html>
