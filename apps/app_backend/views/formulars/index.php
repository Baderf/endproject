<div class="wrapper clearfix">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="btn btn-default btn-lg btn-back btn-self">Back</a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="text-align: right;">
            <a href="formulars/newFormular" class="btn btn-default btn-lg btn-back btn-self spec_formular">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Create new Formular
            </a>
        </div>

    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 page_header spec_formular">
        <h3>My Formulars</h3>
        <span class="page_quader"></span>
    </div>


    <div class="row left_filter">
        <div class="col-lg-2 col-md-2 col-sm-2 left_filter_area spec_formular">

            <ul class="list">
                <li>
                    <a href="#">All formulars</a>
                </li>

                <li>
                    <a href="#about">In progress</a>
                </li>

                <li>
                    <a href="#services">Completed</a>
                </li>

                <li>
                    <a href="#contact">Latest created</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-10 my_formulars_list">
            <div class="col-lg-12 col-md-12 col-sm-12 my_formulars">
                <h4>All formulars</h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Formular name</th>
                        <th>Created at</th>
                        <th>Updated at</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                        if($data['formulars'] != "none"){
                            foreach ($data['formulars'] as $formular){
                                ?>
                                <tr>
                                    <td><?php
                                    echo $formular['title'];
                                        ?></td>
                                    <td><?php
                                        echo $formular['created_at'];
                                        ?></td>
                                    <td><?php
                                        echo $formular['updated_at'];
                                        ?></td>
                                    <td>
                                        <a href="formulars/delete/<?php
                                        echo $formular['id'];
                                        ?>" class="btn btn-sm btn-warning">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        <a href="formulars/edit/<?php
                                        echo $formular['id'];
                                        ?>" class="btn btn-sm btn-info">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </a>
                                    </td>
                                </tr>
                    <?php

                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="4">You don't have any formulars - <a href="formulars/newFormular">Create new formular!</a></td>
                            </tr>
                    <?php

                        }
                    ?>



                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- /.container -->

</div>
