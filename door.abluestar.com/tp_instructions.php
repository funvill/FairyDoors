<div class='page container'>
  <div class="row">
    <div class='col-md-12'>
      <p class="bg-success" style='padding: 5px 10px; margin: 10px; ' >"<em><?php echo $name ;?></em>" door added successfully!</p>
    </div>
  </div>

  <div class="row">
    <div class='col-md-8'>
      <h1>Door instructions</h1>
      <p>Now that you have added the door our database you will need to print a lable and put it inside the door. <br />
         This lable should help others search for aother magic doors around the city.</p>

      <h3>Instructions</h3>
      <ol>
        <li>Download and print this label</li>
        <li>Paste the lable inside the door</li>
        <li>Add a comment to the door page with a picture of the door</a>
      </ol>
      <br />

      <a role="button" class="btn btn-primary btn-large" href='?act=view&slug=<?php echo $slug ; ?>'>View door page &rarr;</a>

    </div>
    <div class='col-md-4'>
      <h3>Print this Label</h3>
      <div style='border: 1px solid black; padding: 10px; margin: 10px; width: 220px;'>
        <div style='text-align: center; '>
          <img src='https://chart.googleapis.com/chart?chs=200x200&cht=qr&choe=UTF-8&chl=<?php echo urlencode( 'http://doors.abluestar.com/?act=view&slug='. $slug ) ; ?>' />
        </div>
        <strong>Instructions</strong><br />
        1) GoTo: <a href="http://doors.abluestar.com/">doors.abluestar.com</a><br />
        2) Search for "<em><?php echo $name ;?></em>" in the search box.<br />
        3) Add a comment or a picture<br />
      </div>
    </div>
  </div>
</div>
