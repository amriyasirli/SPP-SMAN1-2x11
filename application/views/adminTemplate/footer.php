
<footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?= date('Y') ?> SMAN 1 2x11 Enam Lingkung <div class="bullet"></div> 
          <!-- build with 💜 By <a href="#">Marwan Efendi</a> -->
        </div>
        <div class="footer-right">
          1.0
        </div>
      </footer>
    </div>
  </div>

  
  

  

  
  <!-- General JS Scripts -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="<?= base_url('assets/admin/') ?>js/stisla.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- <script src="<?= base_url('assets/modules/chart.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/page/modules-chartjs.js') ?>"></script> -->
  <!-- Template JS File -->
  <!-- <script src="<?= base_url('assets/admin/') ?>js/scripts.js"></script>
  <script src="<?= base_url('assets/admin/') ?>js/custom.js"></script> --> -->
  <script src="<?= base_url('assets/admin/') ?>js/rupiah.js"></script>


  <?php
    $cek = $this->uri->segment(1);
    $cek2 = $this->uri->segment(2);
    if($cek == "Pembayaran" && $cek2 == ""){
      $dataSiswa = $this->db->get('tbl_siswa')->result_array();
      foreach ($dataSiswa as $row) {
        $siswa [] = $row['id_siswa'];
      }
      $array_siswa = $siswa;
    }
    // var_dump(json_encode($array_siswa));
    // die();

  ?>       

  <!-- </script> -->

  <script type="text/javascript">
    
    function load() {
      $('#id_siswa').focus()
    }

    $(document).ready(function(){
      $('#btnNext').on('click', function() {
        $('#tampil').removeClass('d-none')
        $('#jumlah').focus()
        $.ajax({
              url: "<?php echo base_url("Pembayaran/loadTabelAjax");?>",
              type: "POST",
              data: {
                id_siswa: $('#id_siswa').val(),
                periode: $('#periode').val(),
              },
              cache: false,
              success: function(data){
                // alert(data);
                $.ajax({
                  url: "<?php echo base_url("Pembayaran/loadFormPembayaran");?>",
                  type: "POST",
                  data: {
                    // id_siswa: $('#id_siswa').val(),
                    periode: $('#periode').val(),
                  },
                  cache: false,
                  success: function(data){
                    // alert(data);
                    $('#formPembayaran').html(data); 
                  }
                });
                $('#table').html(data); 
              }
            });
      })

      $('#id_siswa').on('keyup',function(){
        var id_siswa=$(this).val();
        $.ajax({
            type : "POST",
            url  : "<?php echo base_url('Pembayaran/cari')?>",
            dataType : "JSON",
            data : {
              id_siswa: id_siswa,
              // periode: periode,
            },
            cache:false,
            success: function(data){
                $.each(data,function(nama_siswa, nama_kelas){
                    $('#nama_siswa').val(data.nama_siswa);
                    $('#id_kelas').val(data.nama_kelas);
                      
                });
                // $("#btnNext").removeAttr("disabled", "disabled");
                $("#btnNext").removeClass("disabled");
                $("#btnNext").removeClass("btn-secondary");
                $("#btnNext").addClass("btn-primary");
                $('#notfound').addClass('d-none')

                ambilNama()
                ambilProfil()
                ambilTabel()
            },
            error: function() {
              $('#nama_siswa').val('');
              $('#id_kelas').val('');
              $("#btnNext").addClass("disabled");
              $("#btnNext").removeClass("btn-primary");
              $("#btnNext").addClass("btn-secondary");
              $('#tampil').addClass('d-none')
              $('#notfound').removeClass('d-none')
            }
        });
        return false;
      });

      $('#btnInsert').on('click', function() {
        var id_siswa = $('#id_siswa').val();
        var bulan = $('#bulan').val();
        var periode = $('#periodebayar').val();
        var jumlah = $('#jumlah').val();
        var keterangan = $('#keterangan').val();
        if(id_siswa!="" && bulan!="" && jumlah!=""){
          $("#btnInsert").attr("disabled", "disabled");
          $.ajax({
            url: "<?php echo base_url("Pembayaran/savedata");?>",
            type: "POST",
            data: {
              type: 1,
              id_siswa: id_siswa,
              id_guru:2,
              bulan: bulan,
              periode: periode,
              jumlah: jumlah,
              keterangan: keterangan,
            },
            cache: false,
            success: function(dataResult){
              var dataResult = JSON.parse(dataResult);
              if(dataResult.statusCode==200){
                $("#btnInsert").removeAttr("disabled");
                $('#id_siswa').find('input:text').val('');
                $("#success").show();
                $("#success").focus();
                $("#cancel").hide();

                $('#success').html('Data added successfully !'); 		
                $.ajax({
                  url: "<?php echo base_url("Pembayaran/loadTabelAjax");?>",
                  type: "POST",
                  data: {
                    id_siswa: $('#id_siswa').val(),
                    periode: $('#periode').val(),
                  },
                  cache: false,
                  success: function(data){
                    // alert(data);
                    $('#table').html(data); 
                  }
                });				
              }
              else if(dataResult.statusCode==201){
                $("#btnInsert").removeAttr("disabled");
                $("#success").hide();
                $("#cancel").show();
                $("#cancel").focus();
              $('#cancel').html('Pembayaran bulan <b>'+bulan+'</b> sudah tersedia !');
              }
              
            }
          });
        }
        else{
          alert('Lengkapi Form Pembayaran !');
        }
      });

      
      $(document).on("click", ".delete", function() { 
      //alert("Success");
        // var $ele = $(this).parent().parent();
        $.ajax({
          url: "<?php echo base_url("Pembayaran/delete");?>",
          type: "POST",
          cache: false,
          data:{
            type: 2,
            id: $(this).attr("data-id")
          },
          success: function(dataResult){
            $.ajax({
              url: "<?php echo base_url("Pembayaran/loadTabelAjax");?>",
              type: "POST",
              data: {
                id_siswa: $('#id_siswa').val(),
                periode: $('#periode').val(),
              },
              cache: false,
              success: function(data){
                // alert(data);
                $('#table').html(data); 
              }
            });		
          }
        });
      });

      //  Ambil Nama
      function ambilNama() {
        $.ajax({
          url: "<?php echo base_url("Pembayaran/loadDataAjax/");?>",
          type: "POST",
          data: {
            id_siswa: $('#id_siswa').val(),
          },
          cache: false,
          success: function(data){
            // alert(data);
            $('#nama').html(data); 
          }
        });
      }

      // Ambil Profil
      function ambilProfil(){
        $.ajax({
          url: "<?php echo base_url("Pembayaran/loadProfil/");?>",
          type: "POST",
          data: {
            id_siswa: $('#id_siswa').val(),
          },
          cache: false,
          success: function(data){
            // alert(data);
            $('#profil').html(data); 
          }
        });
      }

      // Ambil Data Tabel Pembayaran
      function ambilTabel() {
        $.ajax({
          url: "<?php echo base_url("Pembayaran/loadTabelAjax");?>",
          type: "POST",
          data: {
            id_siswa: $('#id_siswa').val(),
            periode: $('#periode').val(),
          },
          cache: false,
          success: function(data){
            // alert(data);
            $('#table').html(data); 
          }
        });
      }

      
      

      ambilNama()
      ambilProfil()
      ambilTabel()

    });
  </script>




  <!-- Page Specific JS File -->
  <script>
    $(document).ready(function() {
      $('#summernote1').summernote({
        placeholder: 'Ketikan visi',
        tabsize: 2,
        height: 200
      });
    });

    $(document).ready(function() {
    $('#myTable').DataTable();
} );
  </script>



  <script>
    $(document).ready(function() {
      $('#summernote2').summernote({
        placeholder: 'Ketikan misi',
        tabsize: 2,
        height: 200
      });
    });
  </script>






</body>
</html>