<style>
    .wrapper-tab {
        position: relative;
        margin: 0 auto;
        overflow: hidden;
        padding: 5px;
        height: 50px;
    }
    .list-tab {
        position: absolute;
        left: 0px;
        top: 0px;
        min-width: 3000px;
        margin-left: 12px;
        margin-top: 0px;
    }
    .list-tab li {
        display: table-cell;
        position: relative;
        text-align: center;
        cursor: grab;
        cursor: -webkit-grab;
        color: #efefef;
        vertical-align: middle;
    }
    .scroller {
        text-align: center;
        cursor: pointer;
        display: block;
        padding: 7px;
        padding-top: 11px;
        white-space: no-wrap;
        vertical-align: middle;
        background-color: #fff;
    }
    .scroller-right {
        float: right;
    }
    .scroller-left {
        float: right;
    }
</style>
<div class="container">
    <div class="loadSpinner">
        Memuat 
        <i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <nav>
                <div class="scroller scroller-right">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </div>
                <div class="scroller scroller-left">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                </div>
                <div class="wrapper-tab">
                    <div class="nav nav-tabs list-tab" id="nav-tab" role="tablist">
                    
                    </div>
                </div>
            </nav>
            <div class="tab-content py-5 px-2" id="nav-tabContent">
            </div>
            </div>
        </div>
    </div>
    <!-- MODAL EDIT-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"> 
                        EDIT [nama_coa]
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;
          </span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal
                    </button>
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        let data;
        $.getJSON("<?php echo base_url().'m_coa/json';?>", function(result) {
            data = result;
            $(".loadSpinner").hide();
            console.log(data);
            let indexKategori = 0;
            for (const kategori in data) {
                
                addKategoriTabHTML(indexKategori, data[kategori]['nama_kategori']);
                let indexKelompok = 0;
                for (const kelompok in data[kategori]['kelompok']) {
                    addKelompokListHTML(indexKategori, indexKelompok, data[kategori]['kelompok'][kelompok]['nama_kelompok']);
                            let indexCoa = 1;
                            const addList = '<li class="list-group-item add-coa-input">'+
                                        '<a href="#" class="d-flex align-items-center" onclick="addCoaModal(\''+indexKategori+'\', \''+indexKelompok+'\',\''+kelompok+'\', event)"><i class="fa fa-plus-circle fs-20 pr-4" aria-hidden="true"></i>'+
                                        'Tambah COA</a>'+
                                    '</li>';
                                    $('.tab-pane#KAT'+indexKategori+' ul#KEL'+indexKelompok+'').append(addList);
                            data[kategori]['kelompok'][kelompok]['coa'].forEach(coa => {
                                // console.log(coa);
                                    addCoaListHTML(indexKategori, indexKelompok, kelompok, coa.uniqid, coa.id_coa, coa.nama_coa)
                            });
                            
                    
                    
                    indexKelompok++; 
                }
                indexKategori++;
            }

            initilizeScroolTabList();
        });

        function addKategoriTabHTML(indexKategori, kategori){
            const tabList = '<li><a class="nav-item nav-link ' + (indexKategori === 0 ? 'active' : '') + '" id="KAT' + indexKategori + '-tab" data-toggle="tab" href="#KAT' + indexKategori + '" role="tab" aria-controls="KAT' + indexKategori + '" aria-selected="true">' + kategori + '</a></li>'
            const paneList = '<div class="tab-pane fade '+(indexKategori === 0 ? 'show active' : '')+'" id="KAT'+indexKategori+'" role="tabpanel" aria-labelledby="KAT'+indexKategori+'-tab"><div>';
            $('.list-tab').append(tabList);
            $('.tab-content').append(paneList);
        }
        function addKelompokListHTML(indexKategori, indexKelompok, kelompok){
            const kelompokList = '<ul class="list-group list-group-flush m-0" id="KEL'+ indexKelompok +'"><li class="list-group-item list-group-item-secondary">'+kelompok+'</li></ul>';
            $('.tab-pane#KAT'+indexKategori).append(kelompokList);
        }
        function addCoaListHTML(indexKategori, indexKelompok, kelompok, uniqid, id_coa, coa){
            coaList =   '<li class="list-group-item">' +
                                            '<div class="row">' +
                                                '<div class="col-11" ><b>' +
                                                    id_coa + '</b> ' +coa +
                                                '</div>' +
                                                '<div class="col-1 d-flex align-items-center">' +
                                                    '<a href="#" data-toggle="modal" data-target="#modal" onclick="editCoaModal(\''+indexKategori+'\',\''+ indexKelompok + '\', this, \''+uniqid+'\')">' +
                                                        '<i class="fa fa-pencil fs-20" aria-hidden="true"></i> ' +
                                                    '</a>' +
                                                '</div>' +
                                            '</div>' +
                                        '</li>';    
            
            $('.tab-pane#KAT'+indexKategori+' #KEL'+indexKelompok + ' li:nth-last-child(2)').after(coaList);
            
        }
        

        function initilizeScroolTabList() {
            var itemPositions = [];
            //lets make this global for simplicity
            var currentPosition = 0;
            var widthOfList = function() {
                itemPositions = [];
                //just in case we need to reset it
                var marginWidth = 28;
                var wrapperWidth = $('.wrapper-tab').innerWidth() - marginWidth;
                var itemsWidth = 0;
                itemPositions.push(0);
                //left most positions
                $('.list-tab li').each(function() {
                    var itemWidth = $(this).outerWidth(true);
                    itemsWidth += itemWidth;
                    if (itemsWidth > wrapperWidth) {
                        itemPositions.push(itemsWidth - wrapperWidth);
                        //push in the left offset to move to the right (or left)
                    }
                });
                return itemsWidth;
            };
            //used to check whether to show either arrow
            var reAdjust = function() {
                if (($('.wrapper').outerWidth()) < widthOfList()) {
                    //$('.scroller-right').show();
                } else {
                    //$('.scroller-right').hide();
                }
                if (getLeftPosi() < 0) {
                    //$('.scroller-left').show();
                }
            };
            var moveRight = function() {
                if (currentPosition + 1 < itemPositions.length) {
                    $('.list-tab').animate({
                        left: "-" + itemPositions[++currentPosition] + "px"
                    }, 'fast', reAdjust);
                }
            }
            var moveLeft = function() {
                    if (currentPosition - 1 >= 0) {
                        $('.list-tab').animate({
                            left: "-" + itemPositions[--currentPosition] + "px"
                        }, 'fast', reAdjust);
                    }
                }
                //gets the current left scroll position of the list
            var getLeftPosi = function() {
                return $('.list-tab').position().left;
            };
            reAdjust();
            $(window).on('resize', function(e) {
                reAdjust();
            });
            $('.scroller-right').click(function() {
                //widthOfList();
                moveRight();
            });
            $('.scroller-left').click(function() {
                //widthOfList();
                moveLeft();
            });
        }

        

        $(document).on('click', '.nav-item', function() {

            $('.nav-item').removeClass('active');
            $(this).addClass('active');
            var selectedTab = $(this).attr('aria-controls');
            $('.tab-pane').removeClass('show active');
            $('#' + selectedTab).addClass('show active');
        })

        function addCoaModal(indexKategori, indexKelompok, kelompok, event){
            $('#modal .modal-title').text("Tambah COA");
            $('#modal .modal-footer').html('<button type="button" class="btn btn-primary" id="addbutton" >Tambah</button>');
            fillModal('');  
            $('#modal').modal('show');
            $('#modal #addbutton').on('click',function(){
                $(this).html("<i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i>");
                const datas = $('#modal .modal-body form').serializeArray();
                const data = {};
                datas.forEach(val => {
                    data[val.name] = val.value;
                });
                $.getJSON("<?php echo base_url().'m_coa/get_coa_id/';?>"+data.idCoa, function(newCoa) {
                    if(newCoa.length == 0){
                        var jqxhr = $.post( "<?php echo base_url().'m_coa/add_coa/';?>", {   kelompok: kelompok, idCoa: data.idCoa, nama_coa: data.namaCoa, saldo_awal: data.saldoAwal, saldo_normal_special: data.saldoNormal, quantity: data.quantity })
                        .done(function(res) {
                            $('#modal').modal('toggle');
                            console.log(res);
                            uniqid= 0;
                            
                            if(res > 0){
                                
                                $.getJSON("<?php echo base_url().'m_coa/get_coa/';?>"+res, function(newCoa) {
                                    newCoa = newCoa[0];
                                    addCoaListHTML(indexKategori, indexKelompok,kelompok, newCoa.uniqid, newCoa.id_coa, newCoa.nama_coa);
                                    $('#modal').modal('hide');
                                });
                            }
                        })
                        .fail(function(error) {
                            console.log(error);
                        }) 
                    }else{
                        $('#modal #addbutton').html("<span>Tambah</span>");
                        alert('Duplicate ID');
                        
                    }
                });
            })
        }
        
        function editCoaModal(indexKategori, indexKelompok, event, uniqid) {
            $('#modal .modal-title').html("Memuat <i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i>");
            $('#modal .modal-body').html('');
            $('#modal .modal-footer').html('');
            $.getJSON("<?php echo base_url().'m_coa/get_coa/';?>"+uniqid, function(result) {
                result = result[0];
                fillModal(result);
                $('#modal .modal-title').html("EDIT <b>" + result.nama_coa+ "</b>");
                $('#modal .modal-footer').html('<button type="button" class="btn btn-primary" id="savebutton">Simpan</button>');
                $('#modal').modal('show');
                
                $('#modal #savebutton').on('click',function(){
                $(this).html("<i class='fa fa-circle-o-notch fa-spin' aria-hidden='true'></i>");
                const datas = $('#modal .modal-body form').serializeArray();
                const data = {};
                datas.forEach(val => {
                    data[val.name] = val.value;
                });
                console.log(data);
                var jqxhr = $.post( "<?php echo base_url().'m_coa/update_coa/';?>", {   uniqid: uniqid, id_kelompok_coa: result.id_kelompok_coa, nama_coa: data.namaCoa, saldo_awal: data.saldoAwal, saldo_normal_special: data.saldoNormal, quantity: data.quantity })
                .done(function(res) {
                    console.log(res);
                    if(res){
                        $('#modal').modal('hide');
                        coaList =   '<div class="row">' +
                                                '<div class="col-11" ><b>' +
                                                result.id_coa + '</b> ' + data.namaCoa +
                                                '</div>' +
                                                '<div class="col-1 d-flex align-items-center">' +
                                                    '<a href="#" data-toggle="modal" data-target="#modal" onclick="editCoaModal(\''+indexKategori+'\',\''+ indexKelompok + '\', this, \''+uniqid+'\')">' +
                                                        '<i class="fa fa-pencil fs-20" aria-hidden="true"></i> ' +
                                                    '</a>' +
                                                '</div>' +
                                            '</div>'; 
                        console.log($(event).parents('li'));
                        $(event).parents('li').html(coaList);
                    }
                })
                .fail(function(error) {
                    console.log(error);
                }) 
            })

            });
        }

        function editCoa(uniqid, event){
            const datas = $('#modal .modal-body form').serializeArray();
            const data = {};
            datas.forEach(val => {
                data[val.name] = val.value;
            });
            var jqxhr = $.post( "<?php echo base_url().'m_coa/update_coa/';?>", {   uniqid: uniqid, nama_coa: data.namaCoa, saldo_awal: data.saldoAwal, saldo_normal_special: data.saldoNormal, quantity: data.quantity })
            .done(function(data) {
                
            })
            .fail(function(error) {
                console.log(error);
            }) 
        }

        function fillModal(result){
            formHtml = '<form>'+
                        '<div class="form-group row">' + 
                          '<label for="idCoa" class="col-sm-4 col-form-label">ID COA</label>'  +
                          '<div class="col-sm-8">' +
                          (result.id_coa ? result.id_coa : '<input type="text" autofocus class="form-control-plaintext" id="idCoa" name="idCoa" value=\''+ (result.id_coa ? result.id_coa : '' ) + '\'>' )+
                          '</div>' +
                        '</div>' +
                        '<div class="form-group row">' +
                            '<label for="namaCoa" class="col-sm-4 col-form-label">Nama COA</label>' +
                            '<div class="col-sm-8">' +
                              '<input type="text" class="form-control-plaintext" id="namaCoa" name="namaCoa" value=\''+(result.nama_coa ? result.nama_coa : '')+'\'>' +
                            '</div>' +
                        '</div>' +
                        '<div class="form-group row">' +
                            '<label for="saldoAwal" class="col-sm-4 col-form-label">Saldo Awal</label>'+
                            '<div class="col-sm-8">' +
                              '<input type="text" class="form-control-plaintext" id="saldoAwal" name="saldoAwal" value=\''+(result.saldo_awal ? result.saldo_awal : '' )+'\'>' +
                            '</div>'+
                          '</div>' +
                          '<div class="form-group row">' +
                            '<label for="saldoNormal" class="col-sm-4 col-form-label">Saldo Normal Special</label>' +
                            '<div class="col-sm-8">' +
                              '<input type="text" class="form-control-plaintext" id="saldoNormal" name="saldoNormal" value=\''+(result.saldo_normal_special ? result.saldo_normal_special : '' )+'\'>' +
                            '</div>' +
                          '</div>' +
                          '<div class="form-group row">' +
                            '<label for="quantity" class="col-sm-4 col-form-label">Quantity</label>' +
                            '<div class="col-sm-8">' +
                              '<input type="text" class="form-control-plaintext" id="quantity" name="quantity" value=\''+(result.quantity ? result.quantity : '' )+'\'>' +
                            '</div>' +
                          '</div>' +
                      '</form>';

            $('#modal .modal-body').html(formHtml);
        }
    </script>