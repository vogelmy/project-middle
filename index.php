<?php
$title = 'Home';
require 'functions/config.php';
require 'templates/header.php';


?>

<h1>This is the homepage</h1>
<h3>Text description text description text description text description</h3>

<?php if (!validate_user()): ?>
<form action="http://localhost/Blog_middle/register.php">
    <input type="submit" value="Register Here!" />
</form>
<?php endif; ?>

<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Mauris a diam maecenas sed enim ut. Quis imperdiet massa tincidunt nunc pulvinar sapien et. Tellus at urna condimentum mattis pellentesque id nibh. Leo duis ut diam quam nulla porttitor massa. Et ultrices neque ornare aenean euismod. Orci phasellus egestas tellus rutrum tellus pellentesque. Egestas purus viverra accumsan in nisl nisi. Commodo sed egestas egestas fringilla phasellus faucibus scelerisque eleifend. Est ante in nibh mauris cursus mattis molestie. Blandit massa enim nec dui. Tincidunt ornare massa eget egestas purus viverra. Ut morbi tincidunt augue interdum. Senectus et netus et malesuada fames ac. Convallis tellus id interdum velit laoreet id donec. Quis viverra nibh cras pulvinar mattis. Nullam vehicula ipsum a arcu cursus vitae congue. Ut sem nulla pharetra diam sit amet nisl.

    Pellentesque elit ullamcorper dignissim cras tincidunt. Eu augue ut lectus arcu bibendum at varius vel. Nunc sed blandit libero volutpat sed cras ornare arcu. Nunc lobortis mattis aliquam faucibus purus in massa tempor. Lectus nulla at volutpat diam. Nibh sed pulvinar proin gravida hendrerit lectus. Bibendum est ultricies integer quis auctor elit sed vulputate. Sed odio morbi quis commodo odio. Enim nunc faucibus a pellentesque sit amet porttitor eget. Aliquam id diam maecenas ultricies mi. Sed adipiscing diam donec adipiscing tristique risus nec feugiat. Tellus molestie nunc non blandit massa enim nec dui. Vitae justo eget magna fermentum. Turpis egestas sed tempus urna et pharetra. Dictum at tempor commodo ullamcorper a lacus vestibulum. Adipiscing elit duis tristique sollicitudin nibh sit. Sed libero enim sed faucibus turpis.
    Elit eget gravida cum sociis natoque penatibus et magnis dis. Platea dictumst quisque sagittis purus sit amet. Velit ut tortor pretium viverra. Ut sem nulla pharetra diam sit amet nisl. Montes nascetur ridiculus mus mauris vitae ultricies leo integer malesuada. Rhoncus est pellentesque elit ullamcorper. A diam sollicitudin tempor id eu nisl. Malesuada bibendum arcu vitae elementum curabitur vitae nunc. Lacinia at quis risus sed vulputate odio ut enim. Ornare arcu dui vivamus arcu.</h3>


<?php
require 'templates/footer.php';
