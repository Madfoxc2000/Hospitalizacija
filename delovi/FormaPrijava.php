<meta charset="UTF-8">
<!--==================================== SADRZAJ STRANICE pocinje ovde ------------------------------>
<form ACTION="./Logicki/PrijavaProvera.php" METHOD="POST">
<div class="form-container">
            <div>
                <h1 class="form-header">Пријави се</h1>
            </div>
                <form ACTION="./Logicki/PrijavaProvera.php" METHOD="POST">              
                    <div class="form-content">
                        <div class="input-container">
                                <label for="korisnickoime">Корисник<span aria-label="required">*</span></label>
                                <input type="text" name="korisnickoime" placeholder="Унесите корисничко име"  required>
                            </div>
                            <div class="input-container">
                                <label for="sifra"> Шифра<span aria-label="required">*</span></label>
                                <input type="password" name="sifra" placeholder="Унесите шифру" required>
                            </div>
                        </div>        
                            <div id="signup-btn">
                                <button type="submit" class="signup-btn" name="loginuser" value="Пријави се" >Пријави се</button>
                                <p class="btm-text"> Немате налог? <span class="btm-text-highlighted">Региструј се</span></p>
                            </div>
                </form>
</div>
