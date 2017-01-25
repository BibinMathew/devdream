define(['ojs/ojcore', 'knockout', 'jquery', 'ojs/ojknockout', 'promise', 'ojs/ojtable', 'ojs/ojpagingcontrol'],
function(oj, ko, $)
{   
  function viewModel()
  {
    var self = this;
    self.serviceURL = 'http://127.0.0.1:7101/restapp/rest/1/Employees';
    self.Employees = ko.observableArray([]);
    self.EmplCol = ko.observable();
    //self.pagingDatasource = ko.observable();
    self.fetch = function(successCallBack) {
                    self.EmplCol().fetch({
                        success: successCallBack,
                        error: function(jqXHR, textStatus, errorThrown){
                            console.log('Error in fetch: ' + textStatus);
                        }
                    });
    }
    
    parseEmpl = function(response) {
               return {EmployeeId: response['EmployeeId'],
                       FirstName:  response['FirstName'],
                       LastName:  response['LastName'],
                       Email:  response['Email'],
                       PhoneNumber:  response['PhoneNumber'],
                       Salary:  response['Salary']};
    };
    
    var Employee = oj.Model.extend({
                   urlRoot: self.serviceURL,
                   parse: parseEmpl,
                   idAttribute: 'EmployeeId'
               });
    
    var myEmpl = new Employee();
    
    var EmplCollection = oj.Collection.extend({
                    url: self.serviceURL + "?limit=20",
                    model: myEmpl
    });

    self.EmplCol(new EmplCollection());
    
    self.pagingDatasource = new oj.PagingTableDataSource(new oj.CollectionTableDataSource(self.EmplCol()));
  }
  
  return {'empVM': viewModel};
});