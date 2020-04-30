 <div class="container "  ng-controller="mainController">  
    <div class="container " >
        <h3 class="text-left">{{form_title}}</h3>
        <h4>{{form_subtitle}}</h4>
    </div>
    <section id="intro">        
            <div class="container">
                <div class="col-md-8 col-md-offset-1 animate-box">
                    <form class="form-horizontal alert alert-mm color-palette-set" name="contactForm" id="contactForm"
                        ng-submit="insertInfo(registroMail);" >
                            <div class="form-group row">
                                <div class="col-md-6 field">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" name="nombre" id="nombre" class="form-control" ng-model="registroMail.nombre" required="">
                                </div>

                                <div class="col-md-6 field">
                                        <label for="tema">tema</label>
                                        <input type="text" name="tema" id="tema" class="form-control"  ng-model="registroMail.tema" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 field">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" ng-model="registroMail.email" required="">
                                </div>
                                <div class="col-md-6 field">
                                        <label for="phone">Celular</label>
                                        <input type="text" name="celular" id="celular" class="form-control"  ng-model="registroMail.celular" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 field">
                                        <label for="message">Mensaje</label>
                                        <textarea name="message" id="message" cols="30" rows="08" class="form-control"  ng-model="registroMail.message" required=""></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 field">                                           
                                        <input type="submit" id="submit_btn" class="btn btn-primary" ng-click="sendMail(registroMail)" value={{form_btnEnvia}}>
                                        <input type="button"class="btn btn-primary" ng-click="reset()" value={{form_btnBorra}}>
                                </div>                            
                                <div class="col-md-6 field" ng-show="retorno">
                                    <input type="text" name="retorno" id="retorno" class="form-control"  ng-model="registroMail.retorno" readonly="yes" value="{{registroMail.retorno}}">
                                </div>
                            </div>
                    </form>
                </div>

            </div>
      
    </section>
</div>

    <script src="controller/ctrls/contacontacto.ctrl.js" type="text/javascript"></script>
