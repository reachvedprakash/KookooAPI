

<?php
  /* * *
   * Use Collect DTMF to collect DTMF input from user.
   * 
   * 
   * 
   */


   
  require 'response.php';
  require 'Request.php';
  require 'router.php';
  


  $r = new response();
    // $r->addPlayText("I love koo koo");
    if (isset($_REQUEST['event']) && $_REQUEST['event'] == 'NewCall') 
    {
        $cd = new CollectDtmf(); //initiate new collect dtmf object
        $cd->addPlayText("Press 1, Male");
        $cd->addPlayText("Press 2, Female");
        $r->addCollectDtmf($cd);
    } 
    elseif (isset($_REQUEST['event']) && $_REQUEST['event'] == 'GotDTMF')
    {
        $dm = new CollectDtmf();
        if (isset($_REQUEST['data']) && !empty($_REQUEST['data']))
        {
            if ($_REQUEST['data']=="1")
            {
                
                $dm->addPlayText("Press 3, Above 21");
                $dm->addPlayText("Press 4, Below 21");
                $r->addCollectDtmf($dm);
            }
            elseif($_REQUEST['data']=="2")
            {
                
                $dm->addPlayText("Press 3, Above 18");
                $dm->addPlayText("Press 4, Below 18");
                $r->addCollectDtmf($dm);
            }
            elseif ($_REQUEST['data']=="3")
            {
                $r->addPlayText("You are adult");
                $r->addHangup();
            }
            elseif($_REQUEST['data']=="4")
            {
                $r->addPlayText("You are minor");
                $r->addHangup();
            }
            else
            {
                $r->addHangup();
            }
        }
    }
    
    else
    {
        $r->addHangup();
    }
    $r->send();

$router = new Router(new Request);
$router->get('/([A-Za-z]+)', function() {});
$router->get('/1', function() {});
$router->get('/2', function() {});

   //include response.php into your code
  
?>