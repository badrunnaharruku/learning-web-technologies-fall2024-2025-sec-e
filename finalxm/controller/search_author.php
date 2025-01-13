<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        
        <input type="text" id="search" placeholder="Search Author">
        <div id="searchResults"></div>
        <script>
            document.getElementById('search').onkeyup = function() {
    var query = this.value;
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "search_author.php?query=" + query, true);
    xhr.onload = function() {
        document.getElementById('searchResults').innerHTML = xhr.responseText;
    };
    xhr.send();
};
        </script>
    </body>
</html>

<?php


include '../model/db_connection.php';
$search = $_GET['query'];
$sql = "SELECT * FROM authors WHERE author_name LIKE '%$search%'";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>" . $row['author_name'] . " - " . $row['contact_no'] . "</p>";
}
?>
