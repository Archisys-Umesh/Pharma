function dashboard_intro()
{
    var placementRight = 'right';
    var placementLeft = 'left';

    // Define the tour!
    var tour = {
        id: "my-intro",
        steps: [
            {
                target: "pendingActionLink",
                title: "Pending Action",
                content: "Here you can find any pending actions, that needs your attention",
                placement: placementLeft,
                yOffset: 10
            },
            {
                target: 'addExpenseLink',
                title: "Add Expensys",
                content: "You can add expensys from here",
                placement: 'bottom',
                zindex: 999
            },
             {
                target: 'addtripWidgetEss',
                title: "Add Trips",
                content: "You can add trips from here",
                placement: 'bottom',
                zindex: 999
            },
            
            {
                target: 'approveExpenseLink',
                title: "Approve Expenses",
                content: "You can approve expenses from here",
                placement: 'bottom',
                zindex: 999
            },
            {
                target: 'approveTripLink',
                title: "Approve Trips",
                content: "You can approve trips from here",
                placement: 'bottom',
                zindex: 999
            }
            
            
        ],
        showPrevButton: true
    };

    // Start the tour!
    hopscotch.startTour(tour);                
}

function employeeIntro()
{    
    var placementRight = 'right';
    var placementLeft = 'left';
    
    // Define the tour!
    var tour = {
        id: "employeeIntro",
        steps: [
            {
                target: "btnAddEmployee",
                title: "The First Step",
                content: "Is to add your employees by clicking on the `Add employee` button",
                placement: placementRight,
                yOffset: -15
            },
            {
                target: 'empBlock',
                title: "Click for more details",
                content: "You can also edit your employees' profile info here.",
                placement: 'bottom',
                zindex: 999
            },
            {
                target: 'empFilter',
                title: "Find your employee here",
                content: "Enter your employee's name and tada! There they are...",
                placement: placementLeft,
                zindex: 999
            },
            
        ],
        showPrevButton: true
    };

    setTimeout(function(){
        hopscotch.startTour(tour);                
    },3000);
    // Start the tour!
    
}

function expenseHeadIntro()
{    
    var placementRight = 'right';
    var placementLeft = 'left';
    
    // Define the tour!
    var tour = {
        id: "expenseHeadIntro",
        steps: [
            {
                target: "btnAddPrimary",
                title: "Add Expense Heads",
                content: "Click on the button to create 'Expense types' and to assign their respective policies.",
                placement: placementRight,
                yOffset: 10
            },
            
        ],
        showPrevButton: true
    };

    
    hopscotch.startTour(tour);                
    // Start the tour!
    
}

function approverIntro()
{        
    
    // Define the tour!
    var tour = {
        id: "approverIntro",
        steps: [
            {
                target: "approveExpenseLink",
                title: "Approve Expenses",
                content: "To know how to approve expenses click here",
                placement: 'bottom',
                yOffset: -20
            },
            {
                target: "approveTripLink",
                title: "Approve Trips",
                content: "To know how to approve trips click here",
                placement: 'bottom',
                yOffset: -20
            }
            
        ],
        showPrevButton: true
    };

    
    hopscotch.startTour(tour);                
    
}

function tripSingleIntro()
{    
    var placementRight = 'right';
    var placementLeft = 'left';
    var placementTop = 'top';
    
    // Define the tour!
    var tour = {
        id: "tripSingleIntro",
        steps: [
            {
                target: "approveReject",
                title: "Approve/Reject",
                content: "To approve or reject the trip click here",
                placement: placementTop,
                yOffset: 10
            }
            
        ],
        showPrevButton: true
    };

    
    hopscotch.startTour(tour);                
    
}

function auditorIntro()
{    
    var placementRight = 'right';
    var placementLeft = 'left';
    var placementTop = 'top';
    
    // Define the tour!
    var tour = {
        id: "auditorIntro",
        steps: [
            {
                target: "processPayment",
                title: "Proceed for Payment",
                content: "Select the employee whose payment you wish to approve and click on proceed",
                placement: placementTop,
                yOffset: 10
            },
            {
                target: "holdResign",
                title: "Hold/Resign",
                content: "To hold an employee payment click here",
                placement: placementTop,
                yOffset: 10
            }
            
        ],
        showPrevButton: true
    };

    
    hopscotch.startTour(tour);                
    
}