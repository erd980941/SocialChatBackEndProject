<?php  

$kategorisor=$db->prepare("SELECT * FROM kategori where kategori_durum=:kategori_durum order by kategori_sira ASC");
$kategorisor->execute(array('kategori_durum'=>1));
?>
<div class="col-lg-3">
			<h3>Kategoriler</h3><hr>
			<ul style="margin-bottom: 50px;" class="list-group">
				<?php 
				while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) 
				{
					$kategori_id=$kategoricek['kategori_id'];
					$urunsay=$db->prepare("SELECT COUNT(kategori_id) as say FROM urun WHERE kategori_id=:id and urun_cinsiyet=:cinsiyet and urun_durum=:durum");
					$urunsay->execute(array('id'=>$kategori_id,'cinsiyet'=>'K','durum'=>1));
					$saycek=$urunsay->fetch(PDO::FETCH_ASSOC);

					?>
					<li class="list-group-item d-flex justify-content-between align-items-center">
						<a href="erkekkategori-<?php echo $kategoricek['kategori_seourl']."-".$kategoricek['kategori_id']  ?>"><?php echo $kategoricek['kategori_ad']; ?></a>
						<span class="badge badge-primary badge-pill badgekategori"><?php echo $saycek['say']; ?></span>
					</li>
					<?php
				}
				?>
			</ul>
			<h3>Filtreleme</h3><hr>
			<form>
				<div class="form-group">					
					<div class="md-form">
						<select class="form-control kategorisirala" id="exampleFormControlSelect1">
							<option>Sıralama</option>
							<option>Artan Fiyat</option>
							<option>Azalan Fiyat</option>
							<option>Tarihe Göre</option>
						</select>						
					</div>
				</div>				
				<div class="form-group">					
					<div class="md-form">
						<select class="form-control kategorisirala" id="exampleFormControlSelect1">
							<option>Fiyat</option>
							<option>0 - 100</option>
							<option>100 - 150</option>
							<option>150 - 200</option>
						</select>						
					</div>
				</div>
				<div class="form-group">					
					<button type="button" class="btn btn-block btn-kategori">Filtrele</button>
				</div>
			</form>
			<div class="reklamkategori">
				<h2><b><strong>SPONSORLUK</strong></b></h2>
			</div>
		</div>