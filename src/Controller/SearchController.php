<?php
namespace Controller;


class SearchController
{
    public function indexAction()
    {
        header('Content-Type: application/json');
        $conn = \MovieSearch\Connexion::getInstance();

        $title = $_GET['title'];
        $duration = $_GET['duration'];
        $yearStart = $_GET['year_start'];
        $yearEnd = $_GET['year_end'];
        $gender = $_GET['gender'];
        $author = $_GET['author'];

        if (isset($title)) {
            $sqlTitle = " SELECT * FROM film_director
                          INNER JOIN artist AS a
                          ON artist_id = a.id
                          INNER JOIN film AS f
                          ON film_director.film_id = f.id
                          WHERE f.title
                          LIKE '%$title%' ";
        }

        if (isset($duration)) {
            if ($duration == "all") {
                $sqlDuration = "";

            } else if ($duration == "lessHour") {
                $sqlDuration = " AND duration < 3600";

            } else if ($duration == "between1Hour") {
                $sqlDuration = " AND duration BETWEEN 3600 AND 5400 ";

            } else if ($duration == "between2Hour") {
                $sqlDuration = " AND duration BETWEEN 5400 AND 9000 ";

            } else if ($duration == "moreHour") {
                $sqlDuration = " AND duration > 9000 ";
            }
        }


        if (isset($yearStart)) {
            $sqlYearStart = " AND year >= '$yearStart' ";
        }

        if (empty($yearStart)) {
            $sqlYearStart = "";
        }

        if (isset($yearEnd)) {
            $sqlYearEnd = " AND year <= '$yearEnd' ";
        }

        if (empty($yearEnd)) {
            $sqlYearEnd = "";
        }

        if (!empty($author)) {
            $qAuthor = "SELECT * FROM artist 
                        INNER JOIN film_director ON film_director.artist_id = artist.id 
                        INNER JOIN film ON film.id = film_director.film_id WHERE last_name=:last_name";
            $stmt = $conn->prepare($qAuthor);
            $stmt->bindParam("last_name", $author);
            $stmt->execute();
            $artistName = $stmt->fetchAll();
            return json_encode(["artistName" => $artistName]);
        }

        if (!empty($gender) && $gender == 'm' || $gender == 'M' || $gender == 'f' || $gender == 'F') {
            $sqlGender = "SELECT * FROM artist
                          INNER JOIN film_director ON film_director.artist_id = artist.id
                           INNER JOIN film ON film.id = film_director.film_id WHERE gender=:gender";
            $stmt = $conn->prepare($sqlGender);
            $stmt->bindParam("gender", $gender);
            $stmt->execute();
            $artistGender = $stmt->fetchAll();
            return json_encode(["artist" => $artistGender]);
        }

        $stmt = $conn->prepare($sqlTitle . $sqlDuration . $sqlYearStart . $sqlYearEnd);
        $stmt->execute();
        $films = $stmt->fetchAll();

        if (empty($films)) {
            return json_encode(["errors" => 'Aucun film trouvé']);
        } else {
            return json_encode(["films" => $films]);
        }
    }

}