import tkinter

class LoginPage(tkinter.Frame):
    def __init__(self, master):
        self.master = master

        self.frame = tkinter.Frame(self.master)
        self.emailLabel = tkinter.Label(top, text="Email: ")
        self.emailEntry = tkinter.Entry(top)
        self.passwordLabel = tkinter.Label(top, text="Password: ")
        self.passwordEntry = tkinter.Entry(top, show="*")
        self.loginButton = tkinter.Button(top, text="Login", command=self.login)

        self.emailLabel.grid(row=0, column=0)
        self.emailEntry.grid(row=0, column=1)
        self.passwordLabel.grid(row=1, column=0)
        self.passwordEntry.grid(row=1, column=1)
        self.loginButton.grid(columnspan=2)

    def newWindow(self):
        self.newWindow = tkinter.Toplevel(self.master)
        self.app = SecondPage(self.newWindow)

    def login(self):
        email = self.emailEntry.get()
        password = self.passwordEntry.get()

        if email == 'sam@sam.com' and password == 'pass':
            self.newWindow()
        else:
            print("Fail")

class SecondPage(tkinter.Frame):
    def __init__(self, master):
        self.master = master
        self.frame = tkinter.Frame(self.master)
        self.quitButton = tkinter.Button(self.frame, text='Quit', width=25, command=self.close_windows)
        self.quitButton.pack()
        self.frame.pack()

    def close_windows(self):
        self.master.destroy()


top = tkinter.Tk()
top.geometry("500x400")
loginPage = LoginPage(top)
top.mainloop()
