package org.apache.jsp;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.jsp.*;

public final class index_jsp extends org.apache.jasper.runtime.HttpJspBase
    implements org.apache.jasper.runtime.JspSourceDependent {

  private static final JspFactory _jspxFactory = JspFactory.getDefaultFactory();

  private static java.util.List<String> _jspx_dependants;

  private org.glassfish.jsp.api.ResourceInjector _jspx_resourceInjector;

  public java.util.List<String> getDependants() {
    return _jspx_dependants;
  }

  public void _jspService(HttpServletRequest request, HttpServletResponse response)
        throws java.io.IOException, ServletException {

    PageContext pageContext = null;
    HttpSession session = null;
    ServletContext application = null;
    ServletConfig config = null;
    JspWriter out = null;
    Object page = this;
    JspWriter _jspx_out = null;
    PageContext _jspx_page_context = null;

    try {
      response.setContentType("text/html");
      pageContext = _jspxFactory.getPageContext(this, request, response,
      			null, true, 8192, true);
      _jspx_page_context = pageContext;
      application = pageContext.getServletContext();
      config = pageContext.getServletConfig();
      session = pageContext.getSession();
      out = pageContext.getOut();
      _jspx_out = out;
      _jspx_resourceInjector = (org.glassfish.jsp.api.ResourceInjector) application.getAttribute("com.sun.appserv.jsp.resource.injector");

      out.write("<link rel=\"stylesheet\" type=\"text/css\" href=\"newcss.css\">\r\n");
      out.write("\r\n");
      out.write("<form action=\"action_page.php\">\r\n");
      out.write("  <div class=\"imgcontainer\">\r\n");
      out.write("    <img src=\"img_girl.jpg\" alt=\"Girl in a jacket\">\r\n");
      out.write("  </div>\r\n");
      out.write("\r\n");
      out.write("  <div class=\"container\">\r\n");
      out.write("    <label for=\"uname\"><b>Username</b></label>\r\n");
      out.write("    <input type=\"text\" placeholder=\"Enter Username\" name=\"uname\" required>\r\n");
      out.write("\r\n");
      out.write("    <label for=\"psw\"><b>Password</b></label>\r\n");
      out.write("    <input type=\"password\" placeholder=\"Enter Password\" name=\"psw\" required>\r\n");
      out.write("\r\n");
      out.write("    <button type=\"submit\">Login</button>\r\n");
      out.write("    <label>\r\n");
      out.write("      <input type=\"checkbox\" checked=\"checked\" name=\"remember\"> Remember me\r\n");
      out.write("    </label>\r\n");
      out.write("  </div>\r\n");
      out.write("\r\n");
      out.write("  <div class=\"container\" style=\"background-color:#f1f1f1\">\r\n");
      out.write("    <button type=\"button\" class=\"cancelbtn\">Cancel</button>\r\n");
      out.write("    <span class=\"psw\">Forgot <a href=\"#\">password?</a></span>\r\n");
      out.write("  </div>\r\n");
      out.write("</form>\r\n");
    } catch (Throwable t) {
      if (!(t instanceof SkipPageException)){
        out = _jspx_out;
        if (out != null && out.getBufferSize() != 0)
          out.clearBuffer();
        if (_jspx_page_context != null) _jspx_page_context.handlePageException(t);
        else throw new ServletException(t);
      }
    } finally {
      _jspxFactory.releasePageContext(_jspx_page_context);
    }
  }
}
