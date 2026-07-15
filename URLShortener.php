<?php

        $URLTable = [
            ["ID"=> 1982, "original_url"=> "https://www.amazon.com/PC-Controller-Wireless-Triggers-Charging-Mac/dp/B0DBLMZJRJ/?_encoding=UTF8&pd_rd_w=KTHm8&content-id=amzn1.sym.745bd9c9-e071-4630-bf60-8a11a608451e&pf_rd_p=745bd9c9-e071-4630-bf60-8a11a608451e&pf_rd_r=H58KF3CQ0PV8M5A02RV2&pd_rd_wg=uaA1G&pd_rd_r=714048b2-64e0-4b15-895c-0a7a610d7de9&ref_=pd_hp_d_r_btf_dealz_dotda_t1_hxwDSD_sspa_dk_gateway&ie=UTF8&psc=1&sloctc=1&sp_csd=d2lkZ2V0TmFtZT1zcF9ob21lcGFnZV9ibGVuZGVk", "short_url"=> "www.streamline.com/1j2", "created_at"=> "08-05-2026", "click_count"=>165],
            ["ID"=> 1983, "original_url"=> "https://www.amazon.com/Rekix-Squeezer-Stainless-Handheld-Exprimidor/dp/B0CFXB35C3/?_encoding=UTF8&pd_rd_w=8KpTp&content-id=amzn1.sym.0a620345-ac35-49bf-833a-4e19f958c030&pf_rd_p=0a620345-ac35-49bf-833a-4e19f958c030&pf_rd_r=H58KF3CQ0PV8M5A02RV2&pd_rd_wg=uaA1G&pd_rd_r=714048b2-64e0-4b15-895c-0a7a610d7de9&ref_=pd_hp_d_r_btf_dealz_m1_t1&th=1", "short_url"=> "www.streamline.com/1j3", "created_at"=> "08-05-2026", "click_count"=>152]
        ];

        class URLEncoder{

            public function shortenURL(string $originURL){
                //Pulls the Table of the saved URL then gets the next available position
                global $URLTable;
                $tableID = count($URLTable) + 1982;
                $shortURL = base_convert($tableID, 10, 36);
                //Inserts the new URL into the URL Table, then returns the shorten URL
                $URLInsert = ["ID"=> $tableID, "original_url"=> $originURL, "short_url"=> "www.streamline.com/".$shortURL, "created_at"=> "07-15-2026", "click_count"=>0];
                $URLTable[] = $URLInsert;
                return "www.streamline.com/".$shortURL;
            }
            public function directURL(string $shortURL){
                //Convert the code into base 10 to find the ID
                $tableID = base_convert($shortURL, 36, 10);
                //Gets the Long URL based on the number, O(1)
                global $URLTable;
                //Increments Click Count
                $URLTable[1982-$tableID]['click_count'] = $URLTable[1982-$tableID]['click_count']+1;
                return $URLTable[1982-$tableID]['original_url'];
                
            }
            public function getClickCount(string $shortURL){
                //Finds the URL's click count
                $tableID = base_convert($shortURL,36,10);
                global $URLTable;
                return $URLTable[1982-$tableID]['click_count'];
            }
        }
        $myURLEncoder = new URLEncoder();
        //POST /shorten: Accepts a long URL and returns a short URL
        echo $myURLEncoder->shortenURL("https://www.amazon.com/eleUniverse-Case%EF%BC%88N502%EF%BC%89-Cooling-Aluminum-Heatsinks/dp/B0CMH8MGY2/?_encoding=UTF8&pd_rd_w=v95fD&content-id=amzn1.sym.abb1a8f9-63a5-4a3a-9205-6bc53d830ddb&pf_rd_p=abb1a8f9-63a5-4a3a-9205-6bc53d830ddb&pf_rd_r=AS3AW4434VMQCV6PWVXT&pd_rd_wg=uzVU1&pd_rd_r=c940593c-5388-48f3-9edd-41e801948f82&ref_=pd_hp_d_r_btf_bmx_gp");
        echo "\n";
        //GET /<short_url>: Redirects to the original long URL.
        echo $myURLEncoder->directURL("1j2");
        echo "\n";
        //GET /analytics/<short_url>: Returns analytics data for the short URL.
        echo $myURLEncoder->getClickCount("1j2");


    ?>