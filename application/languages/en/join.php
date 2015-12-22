<?php
return
    [
        'page-title' => 'join us',
        'title' => 'join',
        'form-header' => 'register',
        'form-desc' => 'thanks for chose to join us please fill the blanks below',
        'inp-header' => [
                                    'name' => 'your full name',
                                    'nickname' => 'your nickname',
                                    'email' => 'your e-mail',
                                    'password' => 'your password',
                                    'password-confirm' => 'confirm your password',
                                    'gender' => 'your gender',
                                    'birthday' => 'your date of birth',
                               ],
        'inp-desc' => [
                                    'name' => 'your first and last name',
                                    'nickname' => 'the unique username that you will use it in the community',
                                    'email' => 'your e-mail address to recovery your settings and receive new feeds',
                                    'password' => 'the secret code to access to your settings',
                                    'password-confirm' => 'please enter your password again',
                                    'birthday' => 'your birthday',
                               ],
        'inp-rules' => [
            'name' => ['only letter are allowed', 'bad words are disallowed'],
            'nickname' => ['the nickname must be unique', 'bad words are disallowed', 'you can\'t use a name look like administration'],
            'email' => ['must be a valid e-mail', 'have to be not used before'],
            'password' => ['must be more than 6 characters'],
            'password-confirm' => ['must be the same as the first password'],
            'gender' => ['female', 'male', 'unset'],
            'birthday' => ['mm/dd/yyyy'],
        ],
    ];