<div class="card">
    <div class="card-body">
        <div class="container">
            <h5><?=$title?> <i class="far fa-comment-dots"></i> (<?=$vars['Count']?>)</h5>
            <div>
                <div class="input-group" style="margin-bottom: 10px;">
                    <textarea id="message" class="form-control" aria-label="With textarea" placeholder="Напишите здесь"></textarea>
                </div>
                <button class="btn btn-success  click-submit" >Отправить <i class="fab fa-telegram-plane"></i></button>
            </div>
            <div class="m-t-20">
                <ul class="list-group list-group-flush">
                <?php foreach ($vars['info'] as $value) : ?>
                    <li class="list-group-item p-h-0 del<?=$value['id']?>">
                        <div class="media m-b-15">
                            <div class="avatar avatar-image">
                                <img src="<?=control_avatar($value['id_user'])?>" alt="<?=TR_Users($value['id_user'], 'name')?>">
                            </div>
                            <div class="media-body m-l-20">
                                <h6 class="m-b-0">
                                    <?php if($value['admin']) : ?>
                                        <a class="text-dark" target="blank_<?=$value['id_user']?>" href="/profil/<?=$value['id_user']?>"><?=User_UNIC($value['id_user'], 'name')?></a>
                                    <?php else : ?>
                                        <a class="text-dark" target="blank_<?=$value['id_user']?>" href="/profil/<?=$value['id_user']?>"><?=TR_Users($value['id_user'], 'name')?></a>
                                    <?php endif; ?>
                                </h6>
                                <span class="font-size-13 text-gray"><?=dateFormatTj($value['date'], 'time')?></span>
                            </div>
                        </div>
                        <span><?=$value['message']?></span>
                        <div class="m-t-15">
                            <ul class="list-inline text-right">
                                <li class="d-inline-block m-r-20" onclick="Sorye()">
                                    <a class="text-dark" href="javascript:void(0)">
                                        <i class="anticon m-r-5 anticon-like"></i>
                                        <span><?=$value['my_like']?></span>
                                    </a>
                                </li>
                                <?php if( $value['id_user'] == $_SESSION['authorize']['id'] ) : ?>
                                    <li class="d-inline-block m-r-20">
                                        <a class="text-dark" href="javascript:void(0)" onclick="dalet_chat_id(`<?=$value['id']?>`, `<?=$value['id_user']?>`)" ><span><i class="anticon anticon-delete"></i> Удалить</span></a>
                                    </li>
                                <?php endif; ?>
                                <li class="d-inline-block m-r-30"  onclick="Sorye()" >
                                    <a class="text-dark" href="javascript:void(0)">
                                        <i class="anticon m-r-5 anticon-pushpin"></i>
                                        <span>Ответить</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?  PaginationUnic('/admin/chat/', $this->route['page'], $vars['Count'], 20); ?>
<style>
    .m-b-15 {margin-bottom: 10px!important;}
    li.list-group-item.p-h-0 {padding-bottom: 5px !important;}
    ul.comm_small {margin-left: 6%;}
</style>
<script>
    var message = document.querySelector('#message');
    var Click = document.querySelector('.click-submit');
    var sorye = document.querySelector('.sorye');
    var sorye2 = document.querySelector('.sorye2');
    function Sorye(){
        alert('Мы разрабатываем этой части!');
    }
    Click.onclick = function(){
        if( message.value ) Ajax_All('add_chat', message.value, '/admin/chat/1');

    }
    function dalet_chat_id(id, $id_user){
        if( $id_user == <?=$_SESSION['authorize']['id']?> ){
            Ajax_All('dalet_chat_id', id, '/admin/chat/1');
            let del = document.querySelector('.del'+id);
            del.style.display = 'none';
        }
    }
    function add_chat(json){
        console.log(json);
    }
</script>
