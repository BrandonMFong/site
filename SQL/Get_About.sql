select Description 
    from type_content tc 
        join site_content sc 
            on tc.ID = sc.Type_ID
    where
        tc.Type = 'About'
        and
        sc.Time >= curdate()