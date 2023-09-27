<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE pocinje ovde ------------------------------>

<div class="form-container-prijava">
            <div>
                <h1 class="form-header">Пријави се</h1>
            </div>
                <form name="prijavaForm" id="prijavaForm" ACTION="./Logicki/PrijavaProvera.php" METHOD="POST">              
                    <div class="form-content">
                        <div class="input-container">
                                <label for="korisnickoIme">Корисник<span aria-label="required">*</span></label>
                                <input type="text" name="korisnickoIme" placeholder="Унесите корисничко име"  required>
                            </div>
                            <div class="input-container">
                                <label for="sifra"> Шифра<span aria-label="required">*</span></label>
                                <input type="password" name="sifra" placeholder="Унесите шифру" required>
                            </div>
                        </div>   

                            <div class="signup-btn-container">
                                <span class="ValidationMessage" id = "KorisnickoMessage"></span>     
                                <button type="submit" class="signup-btn" name="loginuser" value="Пријави се" >Пријави се</button>
                            </div>
                </form>
</div>
