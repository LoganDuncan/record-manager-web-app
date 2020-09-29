<?php // Filename: form.inc.php ?>

<!-- Note the use of sticky fields below -->
<!-- Note the use of the PHP Ternary operator
Scroll down the page
http://php.net/manual/en/language.operators.comparison.php#language.operators.comparison.ternary
-->

<?php 
if (basename($_SERVER['PHP_SELF']) == 'create-record.php') {
    $button_label = "Save New Record";
} elseif (basename($_SERVER['PHP_SELF']) == 'update-record.php') {
    $button_label = "Save Updated Record";
} elseif (basename($_SERVER['PHP_SELF']) == 'advanced-search.php') {
    $button_label = "Search Records";
}
?>

<?php $yes = ''; $no = ''; $degree_program = 'Undefined'; ?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
    <label class="col-form-label" for="first">First Name </label>
    <input class="form-control" type="text" id="first" name="first" value="<?php echo (isset($first) ? $first: '');?>">
    <br>
    <label class="col-form-label" for="last">Last Name </label>
    <input class="form-control" type="text" id="last" name="last" value="<?php echo (isset($last) ? $last: '');?>">
    <br>
    <label class="col-form-label" for="student_id">Student ID </label>
    <input class="form-control" type="text" id="student_id" name="student_id" value="<?php echo (isset($sid) ? $sid: '');?>">
    <br>
    <label class="col-form-label" for="email">Email </label>
    <input class="form-control" type="text" id="email" name="email" value="<?php echo (isset($email) ? $email: '');?>">
    <br>
    <label class="col-form-label" for="phone">Phone </label>
    <input class="form-control" type="text" id="phone" name="phone" value="<?php echo (isset($phone) ? $phone: '');?>">
    <br>
    <label class="col-form-label" for="gpa">GPA </label>
    <input class="form-control" type="text" id="gpa" name="gpa" value="<?php echo (isset($gpa) ? $gpa: '');?>">
    <br>
    <!-- Radio buttom that is sticky and sends a 1 or 0 to the database when submitted. See content.inc.php in the create folder for more. -->
    <fieldset>
    <legend class="col-form-label">Are you receiving financial aid?</legend>
    <label class="form-control" for="yes"><input type="radio" name="financial_aid" value="yes" id="yes" <?php echo $yes; ?>> Yes</label>
    <label class="form-control" for="no"><input type="radio" name="financial_aid" value="no" id="no" <?php echo $no; ?>> No</label>
    </fieldset>
    <br>
    <!-- A sticky select form that sets the name of the degree program to a variable to be sent to SQL later -->
    <label class="col-form-label" for="degree_program">Degree Program </label>
    <select class="form-control" name="degree_program" id="degree_program">
        <option value ="Undeclared"<?php if ($degree_program == 'Undeclared') echo ' selected';?>>Undeclared</option>
        <option value="Web Development"<?php if ($degree_program == 'Web Development') echo ' selected';?>>Web Development</option>
        <option value="DMA"<?php if ($degree_program == 'DMA') echo ' selected';?>>Digital Media Arts</option>
        <option value="Nursing"<?php if ($degree_program == 'Nursing') echo ' selected';?>>Nursing</option>
        <option value="Underwater Basket Weaving"<?php if ($degree_program == 'Underwater Basket Weaving') echo ' selected';?>>Underwater Basket Weaving</option>
        <option value="Software Development"<?php if ($degree_program == 'Software Development') echo ' selected';?>>Software Development</option>
    </select>
    <br>
    <label class="col-form-label" for="graduation_date">Graduation Date</label>
    <br>
    <input type="date" id="graduation_date" name="graduation_date" value="<?php echo (isset($graduation_date) ? $graduation_date: '');?>">
    <br><br><br>
    <a href="display-records.php">Cancel</a>&nbsp;&nbsp;
    <button class="btn btn-primary" type="submit"><?= $button_label ?></button>
    <input class="form-control" type="hidden" name="id" value="<?php echo (isset($id) ? $id : '');?>">
</form>