<!DOCTYPE html>
<html ng-app="angularJSBaseFramework">
    <head>
        <!-- Set your base URL -->
        <base href="/angularJSBaseFramework/portal/"/>

        <!--Load all your different stylesheets here-->

        <!-- Jquery-->

        <!-- Angular App -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
        <script src="resources/js/angular-modules.min.js"></script>


        <!-- Load NGRoute -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.18/angular-route.js"></script>

        <!-- load your app.js -->
        <script src="app/app.js"></script>

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

