<!-- This file holds the main HTML and loads the various controllers-->
<!DOCTYPE html>
<html ng-app="minent">
    <head>
        <!-- Set your base URL -->
        <base href=""/>

        <!--Load all your different stylesheets here-->

        <!-- Angular App -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

        <!--  load all the controllers. Keep in mind all the controllers should be called ...Controller.js  -->
        <?php
        foreach(glob('app/*Controller.js') as $g){
            echo "\t<script src=\"".$g."?v=1\"></script>".PHP_EOL;
        }
        ?>

    </head>

    <body>
        <!-- Main content -->
        <section class="content">
            <ng-view>

            </ng-view>
        </section>

    <!-- Load your javascript files here -->

    </body>
</html>

