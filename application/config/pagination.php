<?php

        //pagination konfig                             
        //$config['total_rows'] = $this->People_model->countData();
        //$config['per_page'] = 5;                              
        
        //styling
        $config['full_tag_open'] = '<nav><ul class="pagination" class="pagination justify-content-end">';
        $config['full_tag_close'] = ' </ul></nav>';

        //jumlah digit
        $config['num_links'] = 4;

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active">  <a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';          

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';   
        
        $config['attributes'] = array('class' => 'page-link');        
                        