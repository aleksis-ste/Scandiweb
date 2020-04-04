function router(routes)
{
    this.routes = routes;

    $(window).on('hashchange', () => {
        this.check(window.location.hash);
    });

    this.init = function ()
    {
        this.check(window.location.hash);
    }

    this.check = function(hash)
    {
        let page = null;

        page = (this.routes).find(route => route == hash);

        if(page == null)
            page = '404';

        return this.render(page);
    }

    this.render = function(page)
    {
        $('#app').load(`/src/frontend/pages/${page.replace('#', '')}.html`);
    }

}

var routes = ['#list', '#add'];

var spaRouter = new router(routes);

spaRouter.init();