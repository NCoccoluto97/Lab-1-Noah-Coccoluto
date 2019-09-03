
<!-- ############ Start of nav ############ -->
<nav>
    
    <ol class="navmid">
        <?php
        print '<li class="';
        if ($path_parts['filename'] == "index") {
            print 'activePage';
        }
        print '">';
        print '<a href="index.php">HOME</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "nrelease") {
            print 'activePage';
        }
        print '">';
        print '<a href="nrelease.php">NEW RELEASES</a>';
        print '</li>';

        /*
          print'<li class="';
          if ($path_parts['filename'] == 'shopping') {
          print 'activePage';
          }
          print '">';
          print '<a href="shopping.php">Shopping</a>';
          print '</li>';
         */
        ?>
            <div class="dropdown">
                <button class="dropbtn">SHOPPING ˅</button>
                <div class="dropdown-content">
                    <a href="shoes.php">SHOES</a>
                    <a href="pants.php">PANTS</a>
                    <a href="shirts.php">SHIRTS</a>
                    <a href="accessories.php">ACCESSORIES</a>
                </div>
            </div>

        <?php
        print '<li class="';
        if ($path_parts['filename'] == 'about') {
            print 'activePage';
        }
        print '">';
        print '<a href="about.php">ABOUT</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == 'form') {
            print 'activePage';
        }
        print '">';
        print '<a href="form.php">JOIN</a>';
        print '</li>';


        print '<li class="';
        if ($path_parts['filename'] == 'contact') {
            print 'activePage';
        }
        print '">';
        print '<a href="contact.php">CONTACT</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "help") {
            print 'activePage';
        }
        print '">';
        print '<a href="help.php">HELP</a>';
        print '</li>';
        ?>

    </ol>
</nav>