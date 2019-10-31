<?php
    
    $Content = utf8_encode($Content);
    $dbname= "apw2_production";
    $usrname= "aidspandev";
    $pwd = "aIdspan008!";
    $dbhost = "184.154.47.58";

    $connect = mysqli_connect($dbhost,$usrname,$pwd,$dbname);
    mysqli_set_charset($connect, 'utf8');

    if (!$connect) {


	echo "connection errror".mysql_error();
    }
	$id = $_GET['id']; 
	$article= mysqli_query ($connect, "
		SELECT 
		web_field_data_field_article_content.field_article_content_value,
		web_field_data_field_article_content.entity_id,
		web_field_data_field_article_content.bundle,
		web_field_data_field_article_author.field_article_author_value,
		web_field_data_field_article_author.entity_type,
		web_node.title, web_node.nid,web_node.changed,
		web_field_data_field_article_number.entity_id,
        web_field_data_field_article_number.field_article_number_value,
        web_field_data_field_article_abstract.field_article_abstract_value,
        web_field_data_field_article_abstract.entity_id
		FROM web_field_data_field_article_content,web_node,
		web_field_data_field_article_abstract,
		web_field_data_field_issue_number,
		web_field_data_field_article_author,
		web_field_data_field_article_number
		WHERE web_field_data_field_article_content.entity_id = web_field_data_field_article_author.entity_id
		AND web_field_data_field_article_content.entity_id = web_node.nid
		AND web_field_data_field_article_content.entity_id = $id
		AND web_node.nid = web_field_data_field_article_number.entity_id
		AND web_field_data_field_article_abstract.entity_id= web_field_data_field_article_content.entity_id

								   	  

					");

	while ($row= mysqli_fetch_array ($article)) {
                    
					$content = $row ['field_article_content_value'];
					$content = str_replace("<a href>", ' ', $content);
					$author = $row ['field_article_author_value'];
					$type = $row ['bundle'];
					$type = str_replace('gfo_', 'GFO ', $type);
					$type = str_replace('_', ' ', $type);		
					$articleTitle = $row ['title'];
					$articleNumber = $row ['field_article_number_value'];
					$abstract = $row ['field_article_abstract_value'];
					$articletime = $row['changed'];
            		$articletime_date=strftime("%e %B %Y");
            		$sharing = html_entity_decode($abstract);
				}
	

    
?>
<?php

$short_url = 'http://aidspan.org';
$url = 'https://play.google.com/store/apps/details?id=org.aidspan.nesletter&hl=en';
$share_text = strip_tags($abstract);

$twitter_params = 
'?text=' . urlencode($share_text).' ---Download GFO Newsletter app for more!---' . '+-' .
'&amp;url=' . urlencode($short_url) . 
'&amp;counturl=' . urlencode($url) .
'';

$facebook_params = 
'?t=' . urlencode($share_text) . '+-' .
'&amp;url=' . urlencode($short_url) . 
'&amp;counturl=' . urlencode($url) .
'';
$whatsapp_params = 
'?text=' . urlencode($share_text) . '+-' .
'&amp;url=' . urlencode($short_url) . 
'&amp;counturl=' . urlencode($url) .
'';


$link_twitter = "http://twitter.com/share" .$twitter_params. "";
$link_fb = $abstract;
$link_whatsapp = "whatsapp://send" . $whatsapp_params ."";

        ?>
<html>
  <head>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Material+Icons"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui"
    />
    <meta property="og:url"                content="http://aidspan.org" />
<meta property="og:type"               content="article" />
<meta property="og:title"              content="When Great Minds Don’t Think Alike" />
<meta property="og:description"        content="How much does culture influence creative thinking?" />
<meta property="og:image"              content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
    <link rel="stylesheet" href="css/main.css">
    
  </head>
  <body>
      <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=845742382431699&autoLogAppEvents=1"></script>
    <div id="app">
      <v-app>
        <v-content>
          <v-toolbar color="white" fixed>
            <v-btn color="#04ABE9" light style="border-radius:20px;color:white" onClick="javascript:history.back()">
              <v-icon dark left>arrow_back</v-icon>Issue
            </v-btn>
          </v-toolbar>
          <v-container style="margin-top: 45px">
            <v-card class="mx-auto" light max-width="100%">
              <v-card-text class="headline font-weight-bold">
              <?php echo $articleTitle;?>
              </v-card-text>

              <v-card-actions>
                <v-list-tile class="grow">
                  <v-list-tile-avatar color="grey darken-3">
                    <v-img
                      class="elevation-6"
                      src="https://pbs.twimg.com/profile_images/2551992296/0h04lodhrk3i4j7d4cn3_400x400.png"
                    ></v-img>
                  </v-list-tile-avatar>

                  <v-list-tile-content>
                    <v-list-tile-title><?php echo $author; ?></v-list-tile-title>
                  </v-list-tile-content>

                  <v-layout align-center justify-end>
                    <v-icon class="mr-1">mdi-heart</v-icon>
                    <span class="subheading mr-2"></span>
                    <v-icon class="mr-1">mdi-share-variant</v-icon>
                    <span class="subheading bold">article: <?php echo $articleNumber ?></span>
                  </v-layout>
                </v-list-tile>
              </v-card-actions>
            </v-card>

            <v-card
              class="mx-auto"
              color="#04ABE9"
              max-width="100%"
              style="margin-top:12px;color:white"
            >
              <v-card-text class="content font-weight-light">
                <h4>Abstract</h4>
                <?php echo $abstract; ?>
              </v-card-text>
            </v-card>
            <v-card class="mx-auto" light max-width="100%">
              <v-card-text class="content font-weight-medium" id="content">
              <?php echo $content; ?>
              </v-card-text>
            </v-card>
            <v-card
              style="margin-top:12px;color:#04ABE9; padding-left: 15px;padding-top: 8px; text-align: center">
            <h3>Share this article</h3>
              <v-card-actions>
               <div class="fb-share-button" data-href="http://aidspan.org/page/current-issue" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Faidspan.org%2Fpage%2Fcurrent-issue&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
               
               <a href="whatsapp://send?text=<?php echo strip_tags($abstract); ?>" class="botao-wpp">
                <!-- ícone -->
                <i class="fa fa-whatsapp"></i>
                whatsapp
                </a>
                <a class="twitter-share-button"
                href="https://twitter.com/intent/tweet?text=<?php echo strip_tags($abstract). "get the app on https://play.google.com/store/apps/details?id=org.aidspan.nesletter&hl=en";?>"
                data-size="large">
                Tweet</a>
              </v-card-actions>
              <v-card-text style="height: 10px; position: relative">
                        <v-btn
                          absolute
                          dark
                          fab
                          top
                          right
                          color="#04ABE9"
                          onClick="topFunction()"
                        >
                        <v-icon class="fa fa-arrow-up"></v-icon>
                        </v-btn>
                      </v-card-text>
            </v-card>
          </v-container>
        </v-content>
      </v-app>
    </div>
    <script>

    </script>


   
     
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vuetify/dist/vuetify.js"></script>
    <script>
      new Vue({ el: "#app" });
      function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}
    </script>
  </body>
</html>