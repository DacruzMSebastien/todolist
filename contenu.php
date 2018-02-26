<section>
  <form method="post">
    <h1>To Be Done</h1>

    <?php
			if (isset($data["todo"])) {
				foreach ($data["todo"] as $key => $value) {
					// tableau todo du fichier JSON
					?>
      <ul>
        <li><input type="checkbox" name="case[]" value="<?=$value?>"><label for="case"><?=$value?></label></li>
      </ul>
      <?php
				}
			}
		?>
      <input class="button" type="submit" value="Add to archives">
  </form>
</section>
<section>
  <form method="post">
    <h1>Archives</h1>
    <?php
			if (isset($data["archives"])) {
				foreach ($data["archives"] as $key => $value) {
				// tableau archive du fichier JSON
					?>
      <p>
        <?=$value?>
      </p>
      <?php
				}
			}
		 ?>
        <input class="button" type="submit" name="clean" value="Clean archives" hidden>
  </form>
</section>
