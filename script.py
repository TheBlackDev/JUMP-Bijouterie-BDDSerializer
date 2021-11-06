import numpy as np
import matplotlib.pyplot as plt
import pandas as pd
import matplotlib.image as imgg

file_path = "C:/Repositories/JUMP-Bijouterie-BDDSerializer/extrait.xslx"

import os

cwd = os.getcwd()  # Get the current working directory (cwd)
files = os.listdir(cwd)  # Get all the files in that directory
#print("Files in %r: %s" % (cwd, files))


df = pd.ExcelFile('extrait_imageless.xlsx').parse('Feuil1');
a = df.head(1)["Lot"][0]

m = imgg.imread('./images/'+str(a)+".jpg")

plt.imshow(m)
plt.show()