<section class="md-main">
    <div class="container">
        <h1>Social</h1>
        <?php

        foreach($youtubeFeed -> items as $video ):

            $videoID = $video -> snippet -> resourceId -> videoId;

            echo "<div class=\"video-cnt\">";
            echo "<h2>{$video -> snippet -> title}</h2>";

            echo "<iframe src=\"http://www.youtube.com/embed/$videoID\" width=\"640\" height=\"390\"></iframe>";

            echo "</div>";

        endforeach;
        ?>

    </div>
</section>