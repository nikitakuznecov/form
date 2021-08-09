    {include "header.tpl"}
     <!-- HEADER -->
      <header>
         <div class="jumbotron">
           <div class="container">
              <div class="row">
                    <div class="col-xs-12 col-sm-7">
                            <h1>Тестовая форма</h1>
                            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
                    </div>
                    <div class="col-xs-12 col-sm-5">
                    <form action="" id="contactform" role="form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group input-group col-xs-12">
                                <span class="input-group-addon"><span class="fas fa-user"></span></span>
                                <input type="text" name="name" class="form-control" placeholder="Ваше имя*" value="" required aria-required="true">
                            </div>
        
                            <div class="form-group input-group  col-xs-12">
                                <span class="input-group-addon"><span class="fas fa-phone"></span></span>
                                <input type="text" name="phone" class="form-control" placeholder="Ваш телефон*" value="" id="phone" required aria-required="true">
                            </div>
    
                            <div class="form-group input-group col-xs-12">
                                <span class="input-group-addon"><span class="fas fa-envelope"></span></span>
                                <input type="email" name="email" class="form-control" placeholder="Ваш E-mail*" id="email" value="" required aria-required="true">
                            </div>
                            <div class="form-group input-group col-xs-12" id="drop-area">
                                <span class="input-group-addon"><span class="fas fa-images"></span></span>
                                <input type="file" name="photo[]" multiple accept=".jpg, .jpeg, .png" class="form-control input-sm" value="" id="photo" required aria-required="true">
                            </div>
                            <div class="form-group col-xs-12">
                                <center><button type="submit" class="btn btn-success submit">Отправить</button></center>
                            </div>
                        </div>
                    </form>
                    </div>
              </div>
            </div>
         </div>
      </header>
      <!-- HEADER END -->

       <!-- MAIN CONTENT -->
       <section class="main">
            <div class="container content">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>E-mail</th>
                            <th>Изображения</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $Users as $key => $value} 
                          <tr>
                            <td>{$value->getId()}</td>
                            <td>{$value->getName()}</td>
                            <td>{$value->getPhone()}</td>
                            <td>{$value->getEmail()}</td>
                            <td>
                               {if count(json_decode($value->getPhoto())) > 0}
                                    {foreach json_decode($value->getPhoto()) as $k => $v} 
                                         <img src="{$v}" width="50px">
                                    {/foreach}
                               {/if}
                                
                            </td>
                          </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
       </section>
      <!-- MAIN CONTENT END -->

      <!-- FOOTER BLOCK -->
      <footer>
           <div class="container">
             
            </div>
      </footer>
      <!-- FOOTER BLOCK END -->

      {include "footer.tpl"}