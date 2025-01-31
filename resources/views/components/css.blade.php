
<style>
    header {
        background-color: rgb(172, 204, 235);
        padding: 0.5rem 1rem;
    }

    .menu {
        background-color: rgb(255, 255, 255);
       
        ul {
            border-bottom: 1px solid rgba(242, 242, 242, 1);
            list-style-type: none;
            margin: 0;
            overflow: hidden;
            padding: 0;
            text-align: right;

            li {
                display: inline-block;

                a {
                    border-radius: 5px;
                    color: rgba(0, 0, 0, .5);
                    display: block;
                    height: 44px;
                    text-decoration: none;
                }
            }

            .logo {
                float: left;
                height: 44px;
                padding: .4rem .5rem;
            }

            .menu-item a{
                border-radius: 5px;
                margin: 5px 0;
                height: 38px;
                line-height: 36px;
                padding: .4rem .65rem;
                text-align: center;
            }
        }
    }

    header li.menu-item a:hover,
    header li.menu-item a:focus {
        background-color: rgba(221, 72, 20, .2);
        color: rgba(221, 72, 20, 1);
    }
</style>


