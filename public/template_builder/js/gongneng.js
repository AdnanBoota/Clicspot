function TT(e) {
    var t;
    $.each(ZTZ, function(n, r) {
        if (n == e) {
            t = r;
            return false
        }
    });
    return t
}
var isDemo = false,
        isBG = true,
        isRadius = true,
        isDarkk = true,
        authorMode = false,
        isDocumentaion = true,
        CC1 = "",
        CC2 = "",
        CC3 = "",
        CC4 = "",
        CC5 = "",
        CC6 = "",
        CC7 = "",
        CC8 = "",
        CC9 = "",
        CC10 = "",
        CC11 = "",
        CC12 = "",
        CC13 = "",
        CC14 = "",
        CC15 = "",
        CC16 = "",
        CC17 = "",
        CC18 = "",
        mC1 = "",
        mC2 = "",
        mC3 = "",
        mC4 = "",
        mC5 = "",
        mC6 = "",
        mC7 = "",
        mC8 = "",
        mC9 = "",
        mC10 = "",
        mC11 = "",
        mC12 = "",
        mC13 = "",
        mC14 = "",
        mC15 = "",
        mC16 = "",
        mC17 = "",
        mC18 = "",
        C1S = "#color1",
        C2S = "#color2",
        C3S = "#color3",
        C4S = "#color4",
        C5S = "#color5",
        C6S = "#color6",
        C7S = "#color7",
        C8S = "#color8",
        C9S = "#color9",
        C10S = "#color10",
        C11S = "#color11",
        C12S = "#color12",
        C13S = "#color13",
        C14S = "#color14",
        C15S = "#color15",
        C16S = "#color16",
        C17S = "#color17",
        C18S = "#color18",
        C1SK = "#picker1",
        C2SK = "#picker2",
        C3SK = "#picker3",
        C4SK = "#picker4",
        C5SK = "#picker5",
        C6SK = "#picker6",
        C7SK = "#picker7",
        C8SK = "#picker8",
        C9SK = "#picker9",
        C10SK = "#picker10",
        C11SK = "#picker11",
        C12SK = "#picker12",
        C13SK = "#picker13",
        C14SK = "#picker14",
        C15SK = "#picker15",
        C16SK = "#picker16",
        C17SK = "#picker17",
        C18SK = "#picker18",
        BgImgUrl1 = "",
        BgChange1 = "",
        BgImgUrl2 = "",
        BgChange2 = "",
        BgImgUrl3 = "",
        BgChange3 = "",
        BgImgUrl4 = "",
        BgChange4 = "",
        BgImgUrl5 = "",
        BgChange5 = "",
        BgImgUrl6 = "",
        BgChange6 = "",
        BgImgUrl7 = "",
        BgChange7 = "",
        BgImgUrl8 = "",
        BgChange8 = "",
        BgImgUrl8 = "",
        BgChange9 = "",
        Radius1 = "",
        rR1 = "",
        Radius2 = "",
        rR2 = "",
        Radius3 = "",
        rR3 = "",
        Radius4 = "",
        rR4 = "",
        Radius5 = "",
        rR5 = "",
        Radius6 = "",
        rR6 = "",
        ZTZ = {
            theme1: "blue",
            theme2: "blue-box",
            theme3: "teal",
            theme4: "teal-box",
            theme5: "orange",
            theme6: "orange-box"
        },
BJZ = ["1", "2", "3", "all"],
        Itm = {
            header: "header",
            headerbanner_1s: "headerbanner_1s",
            headerbanner_2s: "headerbanner_2s",
            headerbanner_3s: "headerbanner_3s",
            service_1s: "service_1s",
            who_we_are_1s:"who_we_are_1s",
            col3_icon_bg:"col3_icon_bg",
            management:"management",
            skills:"skills",
            strat_project:"strat_project",
            testimonial_1s:"testimonial_1s",
            price_1s:"price_1s",
            from_blog_1s:"from_blog_1s",
            portfolio:"portfolio",
            service_2s:"service_2s",
            
            
            

        },
BuFen = {
    MainModules: {
        "Main Modules": ["header", "headerbanner_1s", "headerbanner_2s", "headerbanner_3s", "service_1s","who_we_are_1s","col3_icon_bg","management","skills","strat_project","testimonial_1s","price_1s","from_blog_1s","portfolio","service_2s"]
    }
},
RQz = ["MainModules"],
        RQm = [".BGtable-inner"],
        S320 = /\/\*start320MediaNeiStart/g,
        hS320 = "/*start320MediaNeiStart*/",
        S360 = /\/\*start360MediaNeiStart/g,
        hS360 = "/*start360MediaNeiStart*/",
        S480 = /\/\*start480MediaNeiStart/g,
        hS480 = "/*start480MediaNeiStart*/",
        S640 = /\/\*start640MediaNeiStart/g,
        hS640 = "/*start640MediaNeiStart*/",
        JianJie = "#preheader",
        dlt = ".delete",
        clr = ".clear",
        dpt = ".duplicate",
        opt = ".options",
        BJ = "#layout_switcher",
        ZT = "#theme_switcher",
        YS = "#choose-module-box",
        eW = "620px",
        bo = "body",
        mT = "",
        bFolderName = "",
        patternPath = "",
        isMedia = "pc",
        ContainerCode = "",
        $thisshi = "",
        $theme_lk = "",
        myItem = "",
        guideInfoText = "",
        pnTitle = "#patternTitle",
        ulTitle = "#urlTitle",
        bdSetting = "#border-setting",
        CK = "#iframe",
        hCK = "#hide-iframe",
        tCK = "#temp-iframe",
        pS = "-inline",
        pC = "inline CSS version",
        pT = "newsletter.html",
        pH = "Email Newsletter of this month.",
        Id = "div[rev]",
        IL = "",
        yIL = "",
        IBmL = "",
        IImL = "",
        IPuL = "",
        Udata = "",
        ImmL = "",
        IPmL = "",
        GdIl = "",
        XZH = "",
        LPH = "",
        TPH = "",
        CKDM = "",
        hCKDM = "",
        tCKDM = "",
        zhixingshu = 0,
        OptS = 1,
        zhixingfou, mLg, pName = "",
        LdO, YY = RegExp("<!-- " + "[^<]+" + "◆ -->", "g"),
        jsflay = /\u0075\u0073\u0065\u0072\/\u0064i\u0067i\u0074\u0068/i,
        RgbT = /rgb\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*\)/gi,
        RgbTa = /rgb\(\d+,\s*\d+,\s*\d+\)/gi,
        cke = /\<\!--{cke_protected\}\{C\}/g,
        cke_e = /\%2D\%2D\%3E--\>/g,
        shibie = /\%E2\%97\%86/g,
        ckeSave = /data-cke-saved-[^"]+="[^"]+"/g,
        CR = /\u00a9/g,
        RQQ = /\u00BB/g,
        QUOT = /\&quot;/g,
        imgL = RegExp(/\u0022images\//g),
        imgLb = RegExp(/url\(images\//g),
        media = RegExp(/\@media only screen[^<]+\}/g),
        meta = RegExp(/\<meta[^<]+\>/g),
        konghang = /\n\s*\r/g,
        startMedia = /\/\*startMedia/gi,
        endMedia = /\/\*endMedia\*\//gi,
        MediaNeiEnd = /\/\*MediaNeiEnd\*\//gi,
        MediaNeiStartQx = /\/\*start[^\n]+MediaNeiStart/gi,
        hMediaNeiStart = /MediaNeiStart\*\//g,
        repk = 0,
        BDLJ = "",
        mTm = TT("theme1"),
        mLt = BJZ[0],
        colne_M