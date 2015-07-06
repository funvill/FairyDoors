<div class='page container'>
  <div class="row">
    <div class='col-md-12'>
      <p class="bg-success"><a href="?act=view&slug=<?php echo $slug ; ?>">Door added successfully!</a></p>
    </div>
  </div>

  <div class="row">
    <div class='col-md-8'>
      <h1>Door instructions</h1>
      <p>Now that you have added the door our database you will need to print a lable and put it inside the door. </p>
      <ol>
        <li>Download and print this label</li>
        <li>Past the lable inside the door</li>
        <li>Add a comment to the <a href="?act=view&slug=<?php echo $slug ; ?>">door</a> page with a photo of the door</a>
      </ol>
    </div>
    <div class='col-md-4'>
      <h3>label</h3>
      <div style='border: 1px solid black; padding: 10px; margin: 10px; '>
      <?php
        require_once( 'phpqrcode/qrlib.php') ;
        // outputs image directly into browser, as PNG stream
        QRcode::png('http://doors.abluestar.com/?act=view&slug='. $slug );
        echo '<br /><a href="http://doors.abluestar.com/?act=view&slug='. $slug .'">http://doors.abluestar.com/?act=view&slug='. $slug .'</a>' ;
      ?>
      </div>
    </div>
  </div>
