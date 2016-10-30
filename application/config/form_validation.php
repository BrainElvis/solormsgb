<?php

$config = array(
    'slider' => array(
        array(
            'field' => 'title',
            'label' => 'Slider Title',
            'rules' => 'required'
        )
    ),
    'user_type' => array(
        array(
            'field' => 'title',
            'label' => 'User Type Title',
            'rules' => 'required'
        )
    ),
    'customer_registration' => array(
        array(
            'field' => 'CustFirstName',
            'label' => 'Your First Name',
            'rules' => 'required',
            'errors' => array(
                'required' => 'You must provide your first name',
            ),
        ),
        array(
            'field' => 'CustLastName',
            'label' => 'Your Last Name',
            'rules' => 'required',
            'errors' => array(
                'required' => 'You must provide your last name.',
            ),
        ),
        array(
            'field' => 'CustEmail',
            'label' => 'Email Address',
            'rules' => 'required|valid_email|is_unique[customers.CustEmail]',
            'errors' => array(
                'required' => 'You must provide a valid email address.',
                'is_unique' => 'This %s already exists.'
            ),
        ),
        array(
            'field' => 'CustAdd1',
            'label' => 'Customer Address',
            'rules' => 'required'
        ),
        array(
            'field' => 'CustTown',
            'label' => 'Customer Town',
            'rules' => 'required'
        ),
        array(
            'field' => 'CustArea',
            'label' => 'Customer Area',
            'rules' => 'required'
        ),
        array(
            'field' => 'CustPostcode',
            'label' => 'Customer Post Code',
            'rules' => 'required'
        ),
        array(
            'field' => 'CustMobile',
            'label' => 'Customer Mobile',
            'rules' => 'required'
        )
    ),
);
