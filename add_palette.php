
<!-- hada-->
<section class="col col-md-10">
    <div class="row">
        <?php if(!isset($_GET["numeroPalette"])): ?>
            <form action="action.php" method="post" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-6">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Numero Palette</label>
                        <input type="text" name="numero_palette" id="form2Example1" class="form-control" readonly/>
                                  
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">date controle</label>
                        <input type="date" name="date_controle" id="form2Example2" value="<?php echo date("Y-m-d"); ?>" class="form-control" readonly  />        
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">date palette</label>
                        <input type="date" name="date_palette" id="form2Example2" class="form-control" required  />        
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">variete</label>
                        <input type="text" name="variete" id="form2Example2" class="form-control" required  />        
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">producteur</label>
                        <input type="text" name="producteur" id="form2Example2" class="form-control" required   />        
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">calibre</label>
                        <input type="number" name="calibre" id="form2Example2" class="form-control" required  />        
                              
                    </div>
                    
                </div>
                <!-- Additional columns for input fields -->

                <!-- Image Controle -->
                <div class="col-md-6">
                    
                    
                <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="nombre_fruit">nombre fruit</label>
        <input type="number" name="nombre_fruit" id="nombre_fruit" class="form-control" required />
      </div>
      <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="brunessnebent">brunessnebent</label>
        <input type="number" name="brunessnebent" id="brunessnebent" class="form-control" required />
      </div>
      <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="brunessnebent_taux">Brunessnebent taux</label>
        <input type="text" name="brunessnebent_taux" id="brunessnebent_taux" class="form-control" readonly />
      </div>
      <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="pourriture">Pourriture</label>
        <input type="number" name="pourriture" id="pourriture" class="form-control" required />
      </div>
      <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label" for="pourriture_taux">Pourriture Taux</label>
        <input type="text" name="pourriture_taux" id="pourriture_taux" class="form-control" readonly />
      </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Image Controle</label>
                        <input type="file" name="image_controle" class="form-control" required >          
                    </div>
                </div>

                <!-- Submit button -->
                <div class="col-md-12">
                    <button type="submit" name="ajouter" class="btn btn-primary btn-block mb-4">Ajouter</button>
                </div>
            </form>
        <?php else: ?>
            <?php require_once "config.php"; ?>
            <?php 
                $conn = DbConnection::getConnection();
                $np = $_GET["numeroPalette"];
                $sql = "SELECT * FROM shelf_life WHERE numero_palette = :numero_palette ";
                $stmt = $conn->prepare($sql);
                $stmt->execute([':numero_palette' =>$np]);
                while ($row = $stmt->fetch()):
            ?>
            <form action="action.php" method="post" enctype="multipart/form-data" class="row g-3">
                <div class="col-md-6">
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Numero Palette</label>
                        <input type="text" name="numero_palette" id="form2Example1" value="<?php echo $row["numero_palette"]; ?>" class="form-control" readonly/>                      
                    </div>
                   
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">date controle</label>
                        <input type="date" name="date_controle" id="form2Example2" value="<?php echo date("Y-m-d"); ?>" class="form-control" readonly  />        
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">date palette</label>
                        <input type="date" name="date_palette" id="form2Example2" value="<?php echo $row["date_palette"]; ?>" class="form-control" required   />        
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">variete</label>
                        <input type="text" name="variete" id="form2Example2" value="<?php echo $row["variete"]; ?>" class="form-control" required  />        
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">calibre</label>
                        <input type="number" name="calibre" id="form2Example2" value="<?php echo $row["calibre"]; ?>" class="form-control" required  />        
                              
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">producteur</label>
                        <input type="text" name="producteur" id="form2Example2" value="<?php echo $row["producteur"]; ?>" class="form-control" required  />        
                    </div>
                    <!-- Other input fields -->
                    
                </div>
                <!-- Additional columns for input fields -->

                <!-- Image Controle -->
                <div class="col-md-6">
                    
                    
                    
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">nombre fruit</label>
                        <input type="number" name="nombre_fruit" id="form2Example2" value="<?php echo $row["nombre_fruit"]; ?>" class="form-control" required  />        
                              
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">brunessnebent</label>
                        <input type="number" name="brunessnebent" id="brunessnebent" value="<?php echo $row["brunessnebent"]; ?>" class="form-control" required  />        
                              
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Brunessnebent taux</label>
                        <input type="text" name="brunessnebent_taux" id="brunessnebent_taux" value="<?php echo $row["brunessnebent_taux"] . " %"; ?>" class="form-control" readonly  />        
                              
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Pourriture</label>
                        <input type="number" name="pourriture" id="pourriture" value="<?php echo $row["pourriture"] ; ?>" class="form-control" required  />        
                              
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Pourriture Taux</label>
                        <input type="text" name="pourriture_taux" id="pourriture_taux" value="<?php echo $row["pourriture_taux"] . " %"; ?>" class="form-control" readonly />        
                              
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example2">Image Controle</label>
                        <input type="file" name="image_controle" class="form-control" value="<?php echo $row["image_controle"];?>" required >          
                    </div>
                </div>

                <!-- Submit button -->
                <div class="col-md-12">
                    <button type="submit" name="modifier" class="btn btn-primary btn-block mb-4">Modifier</button>
                </div>
            </form>
            <?php  endwhile; ?>
        <?php endif; ?>
    </div>
</section>
<script>
    document.getElementById('nombre_fruit').addEventListener('input', calculatePercentages);
    document.getElementById('brunessnebent').addEventListener('input', calculatePercentages);
    document.getElementById('pourriture').addEventListener('input', calculatePercentages);

    function calculatePercentages() {
      const nombre_fruit = parseFloat(document.getElementById('nombre_fruit').value) || 0;
      const brunessnebent = parseFloat(document.getElementById('brunessnebent').value) || 0;
      const pourriture = parseFloat(document.getElementById('pourriture').value) || 0;

      const brunessnebent_taux = nombre_fruit ? ((brunessnebent / nombre_fruit) * 100).toFixed(2) : 0;
      const pourriture_taux = nombre_fruit ? ((pourriture / nombre_fruit) * 100).toFixed(2) : 0;

      document.getElementById('brunessnebent_taux').value = brunessnebent_taux + " % ";
      document.getElementById('pourriture_taux').value = pourriture_taux + " % ";
    }
  </script>