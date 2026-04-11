<html>
    <head>
        <style>
            :root {
              --radius: 12px;
              --box-shadow: 0 2px 15px 0 rgb(0 0 0 / 0.2);
              --box-shadow-l: 0 10px 15px -3px rgb(0 0 0 / 0.1);
              
              --bg-light: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%); /* very light blue */
              --c-dark: #04051b; /* very dark blue */
              --bg-dark: #04051b; /* very dark blue */
              --c-light: #fff;
              
              --bg-primer: linear-gradient(135deg, #1e40af, #2563eb); /* blue grads */
              --bg-second: #dbeafe; /* blue 100 */
              --bg-white: #fff;
              --bg-yellow: linear-gradient(135deg, #f2c001, #f5e5a8); /* yellow */
              
              --c-primer: linear-gradient(135deg, #1e40af, #2563eb, #1e3a8a); /* blue grads text*/
              --c-second: #1e3a8a; /* blue 900 */
            }
            
            .dark {
              background: var(--bg-dark);
              color: var(--c-light);
            }
            .light {
              background: var(--bg-light);
              color: var(--c-dark);
              text-align: center;
            }
            
            .block {
              display: flex;
              width: 300px;
              height: 100px;
              padding: 10px;
              margin : 20px auto;
              box-shadow: var(--box-shadow-l);
              border-radius: var(--radius);
            }
            
            .primer {
              background: var(--bg-primer);
            }
            .white {
              background: var(--bg-white);
            }
            .second {
              background: var(--bg-second);
            }
            .yellow {
              background: var(--bg-yellow);
            }
            .c-primer {
              background: var(--c-primer);
              -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        background-clip: text;
            }
            .c-second {
              color: var(--c-second);
            }
        </style>
    </head>
  <body class="light">
    <div>
    <h1>--c-dark</h1>
    <h1 class="c-primer">class primer</h1>
    <h1 class="c-second">--c-second</h1>
    </div>
    <div>
    <span class="block primer">--bg-primer</span>
    <span class="block second">--bg-second</span>
    <span class="block yellow">--bg-yellow</span>
    <span class="block white">--bg-white</span>
      </div>
  </body>
</html>