<div class="container">
    <article>                          
        <div class="work-box">
    <h3 class="heading-txt">Instructor List</h3>
    
    <table id="no-more-tables" class="showDetails">
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
                        <th>Contact No</th>
			<th>Business Name</th>
			<th>Zip Code</th>
		</tr>
	</thead>
	<tbody>
            <?php foreach($details as $d){ ?>
		<tr>
                        <td data-attr="Name"><?php echo stripslashes($d['instructor_fname']).' '.stripslashes($d['instructor_lname']);?></td>
			<td data-attr="Email"><?php echo $d['instructor_email'];?></td>
                        <td data-attr="Contact No"><?php echo $d['instructor_phone_number'];?></td>
			<td data-attr="Business Name" class="business_name" data-title="<b>Phone No : </b><?php echo $d['instructor_phone_number'];?>"><?php echo stripslashes($d['instructor_business_name']); ?></td>
			<td data-attr="Zip Code"><?php echo $d['zip_code']; ?></td>
		</tr>
            <?php } ?>
	</tbody>
</table>
    
    
    <!--<ul class="showDetails">
        <li><span>Name</span><span>Email</span><span>Business Name</span><span>Zip Code</span></li>
        <?php foreach($details as $d){ ?>
        <li data-title="<b>Phone No : </b><?php echo $d['instructor_phone_number'];?>"><span>
        <?php echo stripslashes($d['instructor_fname']).' '.stripslashes($d['instructor_lname']);?></span>
        <span><?php echo $d['instructor_email'];?></span><span class="business_name"><?php echo stripslashes($d['instructor_business_name']); ?></span><span><?php echo $d['zip_code']; ?></span></li>
        <?php } ?>
    </ul>-->
      
        </div>
    </article>
</div>